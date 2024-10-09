<?php 

namespace App\Repositories;

use App\Models\Subscriptions;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class SubscriptionsRepository {

    public function insert(array $data){
        return Subscriptions::create($data);
    }

    public function getSubscriptions(){
        return Subscriptions::where('subscriber', Auth::id())->where('status', 1)->pluck('user')->toArray();
    }

    public function UpdateSubscription(int $id, array $data){
        return Subscriptions::find($id)->update($data);
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

    public function VerifyExistsSubscription(int $id){
        $sub = Subscriptions::where('user', $id)->where('subscriber', Auth::id())->count();
        if($sub == 0){
            return false;
        } else {
            $sub = Subscriptions::where('user', $id)->where('subscriber', Auth::id())->first();
            Subscriptions::where('user', $id)->where('subscriber', Auth::id())->update(['pay'=>'']);
            Http::withHeaders(['access_token' => env('TOKEN_ASAAS')])->delete(env('URL_ASAAS').'/api/v3/payments/'.$sub['pay'])->json();
            return $sub;
        }
    }

    public function getValue(int $id, string $plan){
        $value = User::find($id);
        return $value[$plan];
    }

}