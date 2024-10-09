<?php

namespace App\Http\Controllers;

use App\Models\CreditCards;
use App\Models\Subscriptions;
use App\Models\User;
use Illuminate\Http\Request;

class SubscriptionsController extends Controller
{
    public function CheckoutPage(string $username){
        $user = new User;
        $subs = new Subscriptions;
        $user = $user->getUserByUsername($username);
        if($subs->validSubscription($user['id']) == true){
            return redirect()->route('username', ['username' => str_replace('@', '', $user['username'])]);
        }
        $card = new CreditCards;
        $cards = $card->listCards();
        return view('app.checkout', ['user' => $user, 'discounts' => $subs->getDiscounts($user['id']), 'cards' => $cards]);
    }

    public function FollowingPage(){
        $subs = new Subscriptions;
        $users = $subs->getUsersSubscriptions();
        $expired = $subs->getUsersSubscriptionsExpired();
        return view('app.following', ['users' => $users, 'expired' => $expired]);
    }
}
