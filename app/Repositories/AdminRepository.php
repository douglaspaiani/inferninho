<?php 

namespace App\Repositories;

use App\Models\Subscriptions;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminRepository {

    public function GetCreators(){
        return User::where('creator', 1)->where('ban', 0)->get(['id', 'name', 'email', 'created_at', 'username']);
    }

    public function GetSubscribers(){
        return User::where('creator', 0)->where('ban', 0)->get(['id', 'name', 'email', 'created_at', 'username']);
    }

    public function GetSubscribersByUser(int $id){
        return DB::table('subscriptions')
        ->join('users', 'subscriptions.user', '=', 'users.id')
        ->where('subscriptions.status', 1)
        ->where('subscriptions.subscriber', $id)
        ->select('users.name', 'users.username')
        ->distinct()
        ->get();
    }

    public function CountSubscribers(int $id){
        return Subscriptions::where('user', $id)->where('status', 1)->count();
    }

}