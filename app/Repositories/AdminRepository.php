<?php 

namespace App\Repositories;

use App\Models\Gifts;
use App\Models\PhotosSold;
use App\Models\Posts;
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

    public function CountAllSubscribers($date = null){
        if($date != null){
            $date = explode('-', $date);
            $month = $date[0];
            $year = $date[1];
            return User::where('creator', 0)->where('ban', 0)->whereYear('created_at', $year)->whereMonth('created_at', $month)->count();
        } else {
            return User::where('creator', 0)->where('ban', 0)->count();
        }
    }

    public function CountAllGifts($date = null){
        if($date != null){
            $date = explode('-', $date);
            $month = $date[0];
            $year = $date[1];
            return Gifts::where('status', 1)->whereYear('created_at', $year)->whereMonth('created_at', $month)->count();
        } else {
            return Gifts::where('status', 1)->count();
        }
    }

    public function CountAllCreators($date = null){
        if($date != null){
            $date = explode('-', $date);
            $month = $date[0];
            $year = $date[1];
            return User::where('creator', 1)->where('ban', 0)->whereYear('created_at', $year)->whereMonth('created_at', $month)->count();
        } else {
            return User::where('creator', 1)->where('ban', 0)->count();
        }
    }

    public function CountAllSubscriptions($date = null){
        if($date != null){
            $date = explode('-', $date);
            $month = $date[0];
            $year = $date[1];
            return Subscriptions::where('status', 1)->whereYear('created_at', $year)->whereMonth('created_at', $month)->count();
        } else {
            return Subscriptions::where('status', 1)->count();
        }
        
    }

    public function CountAllViews($date = null){
        if($date != null){
            $date = explode('-', $date);
            $month = $date[0];
            $year = $date[1];
            return Posts::whereYear('created_at', $year)->whereMonth('created_at', $month)->sum('views');
        } else {
            return Posts::sum('views');
        }
        
    }

    public function GetInvoicingSubscriptions($date = null){
        if($date != null){
            $date = explode('-', $date);
            $month = $date[0];
            $year = $date[1];
            return Subscriptions::where('status', 1)->whereYear('created_at', $year)->whereMonth('created_at', $month)->sum('price');
        } else {
            return Subscriptions::where('status', 1)->sum('price');
        }
    }

    public function  GetInvoicingPhotos($date = null){
        if($date != null){
            $date = explode('-', $date);
            $month = $date[0];
            $year = $date[1];
            return PhotosSold::where('status', 1)->whereYear('created_at', $year)->whereMonth('created_at', $month)->sum('value');
        } else {
            return PhotosSold::where('status', 1)->sum('value');
        }
    }

    public function  GetInvoicingGifts($date = null){
        if($date != null){
            $date = explode('-', $date);
            $month = $date[0];
            $year = $date[1];
            return Gifts::where('status', 1)->whereYear('created_at', $year)->whereMonth('created_at', $month)->sum('value');
        } else {
            return Gifts::where('status', 1)->sum('value');
        }
    }

}