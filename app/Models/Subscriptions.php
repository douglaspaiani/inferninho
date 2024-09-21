<?php

namespace App\Models;

use App\Repositories\SubscriptionsRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'final_card'
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
}
