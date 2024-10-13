<?php 

namespace App\Repositories;

use App\Models\PhotosSold;
use Illuminate\Support\Facades\Auth;

class PhotoSoldRepository {

    public function getById(int $id):PhotosSold
    {
        return PhotosSold::where('post', $id)->where('subscriber', Auth::id())->first();
    }

    public function insert(array $data){
        return PhotosSold::create($data);
    }

    public function VerifyPurchased(int $id):bool
    {
        if(PhotosSold::where('post', $id)->where('subscriber', Auth::id())->count() > 0){
            return true;
        } else {
            return false;
        }
    }

    public function UpdatePhotoSold(int $id, array $data)
    {
        $photo = PhotosSold::where('id', $id);
        $photo->update($data);
        return $photo->first();
    }

}