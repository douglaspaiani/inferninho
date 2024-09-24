<?php 

namespace App\Repositories;

use App\Models\PhotosSold;
use Illuminate\Support\Facades\Auth;

class PhotoSoldRepository {

    public function VerifyPurchased(int $id):bool
    {
        if(PhotosSold::where('post', $id)->where('subscriber', Auth::id())->count() > 0){
            return true;
        } else {
            return false;
        }
    }

}