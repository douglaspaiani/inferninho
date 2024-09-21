<?php 

namespace App\Repositories;

use App\Models\Subscriptions;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SubscriptionsRepository {

    public function getSubscriptions(){
        return Subscriptions::where('subscriber', Auth::id())->where('status', 1)->pluck('user')->toArray();
    }
    
    public function validSubscription(int $user):bool
    {
        if(Subscriptions::where('subscriber', Auth::id())->where('user', $user)->where('status', 1)->count() > 0 || $user == Auth::id()){
            return true;
        } else {
            return false;
        }
    }

    public function getUsersSubscriptions(){
        $subs = $this->getSubscriptions();

        $users = DB::table('subscriptions')
        ->join('users', 'subscriptions.user', '=', 'users.id')
        ->where('subscriptions.subscriber', Auth::id())
        ->where('subscriptions.status', 1)
        ->whereIn('subscriptions.user', $subs)
        ->select('subscriptions.renew','subscriptions.due_date', 'users.name', 'users.photo', 'users.username', 'users.verify', 'users.top', 'users.id', 'subscriptions.status')
        ->orderBy('subscriptions.id', 'desc')
        ->get();

        return $users;
    }

    public function getUsersSubscriptionsExpired(){
        $subs = $this->getSubscriptions();

        $users = DB::table('subscriptions')
        ->join('users', 'subscriptions.user', '=', 'users.id')
        ->where('subscriptions.subscriber', Auth::id())
        ->where('subscriptions.status', 0)
        ->whereIn('subscriptions.user', $subs)
        ->select('subscriptions.renew','subscriptions.due_date', 'users.name', 'users.photo', 'users.username', 'users.verify', 'users.top', 'users.id', 'subscriptions.status')
        ->orderBy('subscriptions.id', 'desc')
        ->get();

        return $users;
    }

}