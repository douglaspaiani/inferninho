<?php

namespace App\Models;

use App\Repositories\SubscriptionsRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Subscriptions extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'subscriber',
        'plan',
        'status',
        'renew',
        'due_date',
        'price',
        'method',
        'final_card',
        'pay'
    ];

    protected $SubscriptionsRepository;

    public function __construct()
    {
        $this->SubscriptionsRepository = new SubscriptionsRepository;
    }

    public function getSubscriptions(){
        return $this->SubscriptionsRepository->getSubscriptions();
    }

    public function validSubscription(int $user){
        return $this->SubscriptionsRepository->validSubscription($user);
    }

    public function getDiscounts(int $id){
        $user = User::where('id', $id)->get(['price_1', 'price_3', 'price_6'])->first();
        $value3 = 3 * $user['price_1'];
        $value6 = 6 * $user['price_1'];
        return [
            'discount_3' => '-'.round((($value3 - $user['price_3']) / $value3) * 100),
            'discount_6' => '-'.round((($value6 - $user['price_6']) / $value6) * 100),
        ];
    }

    public function getUsersSubscriptions(){
        return $this->SubscriptionsRepository->getUsersSubscriptions();
    }

    public function getUsersSubscriptionsExpired(){
        return $this->SubscriptionsRepository->getUsersSubscriptionsExpired();
    }

    public function VerifyExistsSubscription(int $id){
        return $this->SubscriptionsRepository->VerifyExistsSubscription($id);
    }

    public function NewSubscription(int $id_creator, int $plan, string $method, string $pay = null){
        $price = $this->getValue($id_creator, $plan);
        
        $data = [
            'user' => $id_creator,
            'subscriber' => Auth::id(),
            'plan' => $plan,
            'status' => 0,
            'renew' => 0,
            'due_date' => Carbon::now()->addMonths($plan),
            'method' => $method,
            'pay' => $pay ?? null,
            'price' => $price
        ];

        $verify = $this->VerifyExistsSubscription($id_creator);
        if($verify){
            $this->UpdateSubscription($verify->id, $data);
            return $this->VerifyExistsSubscription($id_creator);
        }
    
        return $this->SubscriptionsRepository->insert($data);
    }

    public function UpdateSubscription(int $id, array $data){
        return $this->SubscriptionsRepository->UpdateSubscription($id, $data);
    }

    public function getValue(int $id, string $plan, string $coupon = null){
        $value = $this->SubscriptionsRepository->getValue($id, 'price_'.$plan);
        return $value;
    }
}
