<?php

namespace App\Models;

use App\Repositories\PaymentRepository;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class Payment extends Model
{
    use HasFactory;

    protected $PaymentRepository;

    public function __construct()
    {
        $this->PaymentRepository = new PaymentRepository;
    }

    public function split(int $wallet, string $type){
        $percent = 100 - env('PERCENT');
        $data = [
            'walletId' => $wallet,
            'percentualValue' => $percent,
            'description' => 'Comissão de venda de '.$type
        ];

        return $data;

    }

    public function CreateCustomer():void
    {
        $getuser = new User;
        $user = $getuser->getUser();
        $data = [
            'name' => $user['name'],
            'email' => $user['email'],
            'cpfCnpj' => $user['cpf'],
            'mobilePhone' => stringPhone($user['phone']),
            'externalReference' => $user['id'],
            'groupName' => $user['creator'] == 1 ? 'Criadores' : 'Assinantes'
        ];
        $response = Http::withHeaders(['access_token' => env('TOKEN_ASAAS')])->post(env('URL_ASAAS').'/api/v3/customers', $data)->json();

        if($response){
            $getuser->UpdateUser([
                'customer' => $response['id']
            ]);
        }
    }

    public function NewPayment(array $pay)
    {
        $getuser = new User;
        $creator = $getuser->getUserByUsername($pay['username']);
        $user = $getuser->getUser();
        // Subscription
        if($pay['service'] == 'subscription'){
            $sub = new Subscriptions;
            $description = 'Assinatura de conteúdo de '.$creator['name'];
            $value = (float) $sub->getValue($creator['id'], $pay['plan']);
        }
        // Photo
        if($pay['service'] == 'photo'){
            $post = new Posts;
            $description = 'Compra de foto privada de '.$creator['name'];
            $value = (float) $post->getValue($pay['photo']);
        }
        // Gift
        if($pay['service'] == 'gift'){
            $post = new Posts;
            $description = 'Mimo enviado para '.$creator['name'];
            $value = (float) $pay['value'];
        }

        if(!$user['customer']){
            $this->CreateCustomer();
        }

        $data = [
            'customer' => $user['customer'],
            'billingType' => $pay['method'],
            'value' => $value,
            'description' => $description,
            'dueDate' => Carbon::now()->format('Y-m-d')
        ];

        if($pay['method'] == "CREDIT_CARD"){
            $cardIntegrity = new CreditCards;
            if($cardIntegrity->ValidIntegrity($pay['card_id']) == false){
                return ['error' => 'Esse cartão de crédito não pertence á você.'];
            }
            $creditcard = new CreditCards;
            $card = $creditcard->getCard($pay['card_id']);
            $expire = explode('/', $card['valid']);
            $data['creditCard']['holderName'] = $card['name'];
            $data['creditCard']['number'] = str_replace(' ', '', $card['number']);
            $data['creditCard']['expiryMonth'] = $expire[0];
            $data['creditCard']['expiryYear'] = "20".$expire[1];
            $data['creditCard']['ccv'] = $card['code'];
            // infos titular
            $data['creditCardHolderInfo']['name'] = $user['name'];
            $data['creditCardHolderInfo']['email'] = $user['email'];
            $data['creditCardHolderInfo']['cpfCnpj'] = $user['cpf'];
            $data['creditCardHolderInfo']['postalCode'] = $user['zipcode'];
            $data['creditCardHolderInfo']['addressNumber'] = $user['number'];
            $data['creditCardHolderInfo']['addressComplement'] = $user['complement'];
            $data['creditCardHolderInfo']['mobilePhone'] = stringPhone($user['phone']);
        }

        if(!empty($creator['wallet'])){
            $data['split'] = $this->split($creator['wallet'], 'Assinatura');
        }

        // callback success
        if($pay['service'] == 'subscription'){
            $payment = $sub->NewSubscription($creator['id'], $pay['plan'], $pay['method']);
            //$data['callback']['successUrl'] = route('verify-payment', ['id' => $subs->id, 'type' => 'subscription']);
        }
        if($pay['service'] == 'photo'){
            $sold = new PhotosSold;
            $payment = $sold->NewPhotoSold($creator['id'], $pay['photo']);
            //$data['callback']['successUrl'] = route('verify-payment', ['id' => $subs->id, 'type' => 'subscription']);
        }
        if($pay['service'] == 'gift'){
            $gift = new Gifts();
            $payment = $gift->NewGift($creator['id'], $pay['photo'], (float) $value, $pay['private'], $pay['message']);
            //$data['callback']['successUrl'] = route('verify-payment', ['id' => $subs->id, 'type' => 'subscription']);
        }

        $response = Http::withHeaders(['access_token' => env('TOKEN_ASAAS')])->post(env('URL_ASAAS').'/api/v3/payments', $data)->json();
        if($response){

            if(!empty($response['errors'])){
                return ['error'=> $response['errors']['description']];
            }

            if($response['id']){
                if($pay['service'] == 'subscription'){
                    $sub->UpdateSubscription($payment->id, [
                        'pay' => $response['id']
                    ]);
                }
                if($pay['service'] == 'photo'){
                    $sold->UpdatePhotoSold($payment->id, [
                        'pay' => $response['id']
                    ]);
                }
                if($pay['service'] == 'gift'){
                    $gift->UpdateGift($payment->id, [
                        'pay' => $response['id']
                    ]);
                }
            }

            if($pay['method'] == "PIX"){
                $resp = Http::withHeaders(['access_token' => env('TOKEN_ASAAS')])->get(env('URL_ASAAS').'/api/v3/payments/'.$response['id'].'/pixQrCode')->json();
                if($resp){
                    return [
                        'qrcode' => $resp['encodedImage'],
                        'payload' => $resp['payload'],
                        'value' => "R$ ".number_format($value, 2, ',', '.')
                    ];
                } else {
                    return ['error' => 'Erro ao gerar PIX para pagamento, entre em contato com o suporte.'];
                } 
            }

            if(!empty($response['status'])){
                $this->VerifyPayment($payment->id, $pay['service'], $response['status']);
            }
            return ['status' => $response['status']];

        } else {
            return ['error' => 'Erro ao gerar cobrança, entre em contato com o suporte.'];
        }
    }

    public function VerifyPayment(int $id, string $type, string $status = null){
        $pay = $this->PaymentRepository->getById($id, $type);
        if($status == null){
            $response = Http::withHeaders(['access_token' => env('TOKEN_ASAAS')])->get(env('URL_ASAAS').'/api/v3/payments/'.$pay['pay'].'/status')->json();
            $status = $response['status'];
        }
        
        if($status == 'RECEIVED' || $status == 'CONFIRMED'){
            $this->ConfirmPayment($id, $type);
            return true;
        } else {
            return false;
        }
    }

    public function ConfirmPayment(int $id, string $type):void
    {
        $this->PaymentRepository->ConfirmPayment($id, $type);
    }
}
