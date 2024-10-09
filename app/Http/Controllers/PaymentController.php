<?php

namespace App\Http\Controllers;

use App\Models\CreditCards;
use App\Models\Payment;
use App\Models\Posts;
use App\Models\Subscriptions;
use App\Models\User;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function NewPaymentSubscription(string $username, Request $request){
        $pay = new Payment;
        $card = $request->get('card')  ?? null;
        return $pay->NewPayment($username, $card, $request->get('method'), $request->get('plan'));
    }

    public function VerifyPayment(int $id, string $type){
        $pay = new Payment();
        $user = new User;
        $username = $user->getUserById($id);
        if($pay->ConfirmPayment($id, $type) == true){
            return redirect()->route('username', ['username' => str_replace('@', '', $username['username'])])->with(['success' => 'Sua assinatura foi ativada com sucesso. Aproveite!']);
        } else {
            return redirect()->route('username', ['username' => str_replace('@', '', $username['username'])])->withErrors(['error' => 'Estamos aguardando confirmação do pagamento, aguarde alguns minutos.']);
        }
    }

    public function PaymentPhotoPage(int $id){
        $post = new Posts;
        $user = new User;
        $card = new CreditCards;
        $photo = $post->getPost($id);
        $user = $user->getUserById($post->getIdUserByPost($id));
        $cards = $card->listCards();
        if(empty($photo->value)){
            return redirect()->route('home');
        }
        return view('app.payment.paymentPhoto', ['user' => $user, 'post' => $photo, 'cards' => $cards]);
    }
}
