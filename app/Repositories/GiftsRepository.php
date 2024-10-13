<?php 

namespace App\Repositories;

use App\Models\Gifts;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GiftsRepository {

    public function getById(int $id){
        return Gifts::where('post', $id)->where('subscriber', Auth::id())->first();
    }

    public function getAll(){
        return DB::table('gifts')
        ->join('users', 'gifts.user', '=', 'users.id')
        ->where('gifts.status', 1)
        ->select('users.name', 'users.username', 'gifts.value', 'gifts.created_at', 'gifts.id')
        ->get();
    }

    public function insert(array $data){
        return Gifts::create($data);
    }

    public function VerifyPurchased(int $id):bool
    {
        if(Gifts::where('post', $id)->where('subscriber', Auth::id())->count() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function UpdateGift(int $id, array $data)
    {
        $gift = Gifts::where('id', $id);
        $gift->update($data);
        return $gift->first();
    }

}