<?php 

namespace App\Repositories;

use App\Models\Message;
use App\Models\Subscriptions;
use Illuminate\Support\Facades\Auth;

class PaymentRepository {

    public function getById(int $id, string $type){
        if($type == 'subscription'){
            return Subscriptions::find($id);
        }
    }

    public function ConfirmPayment(int $id, string $type){
        if($type == 'subscription'){
            return Subscriptions::find($id)->update(['status' => 1]);
        }
    }

}