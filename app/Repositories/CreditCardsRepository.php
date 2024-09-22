<?php 

namespace App\Repositories;

use App\Models\CreditCards;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CreditCardsRepository {

    public function find(int $id){
        return CreditCards::find($id);
    }

    public function validAddress():bool
    {
        $user = User::find(Auth::id());
        if(empty($user['zipcode']) || empty($user['address']) || empty($user['number']) || empty($user['neighborhood']) || empty($user['city']) || empty($user['state'])){
            return false;
        } else {
            return true;
        }
    }

    public function insertCard(array $data){
        return CreditCards::create($data);
    }

    public function listCards(){
        return CreditCards::where('user', Auth::id())->get(['valid', 'number', 'id', 'brand']);
    }

    public function remove(int $id){
        return CreditCards::find($id)->delete();
    }

}