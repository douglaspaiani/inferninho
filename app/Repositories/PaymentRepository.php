<?php 

namespace App\Repositories;

use App\Models\Gifts;
use App\Models\Message;
use App\Models\PhotosSold;
use App\Models\Subscriptions;
use Illuminate\Support\Facades\Auth;

class PaymentRepository {

    public function getById(int $id, string $type){
        if($type == 'subscription'){
            return Subscriptions::find($id);
        }
        if($type == 'photo'){
            return PhotosSold::find($id);
        }
        if($type == 'gift'){
            return Gifts::find($id);
        }
    }

    public function ConfirmPayment(int $id, string $type){
        if($type == 'subscription'){
            return Subscriptions::find($id)->update(['status' => 1]);
        }
        if($type == 'photo'){
            return PhotosSold::find($id)->update(['status' => 1]);
        }
        if($type == 'gift'){
            return Gifts::find($id)->update(['status' => 1]);
        }
    }

}