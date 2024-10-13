<?php

namespace App\Models;

use App\Repositories\PhotoSoldRepository;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class PhotosSold extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'subscriber',
        'post',
        'value',
        'pay',
        'status'
    ];

    protected $PhotoSoldRepository;

    public function __construct()
    {
        $this->PhotoSoldRepository = new PhotoSoldRepository;
    }

    public function getById(int $id):PhotosSold
    {
        return $this->PhotoSoldRepository->getById($id);
    }

    public function VerifyPurchased(int $id){
        return $this->PhotoSoldRepository->VerifyPurchased($id);
    }

    public function UpdatePhotoSold(int $id, array $data)
    {
        return $this->PhotoSoldRepository->UpdatePhotoSold($id, $data);
    }

    public function NewPhotoSold(int $id_creator, int $id_photo, string $pay = null){
        $post = new Posts;
        $price = $post->getValue($id_photo);
        
        $data = [
            'user' => $id_creator,
            'subscriber' => Auth::id(),
            'post' => $id_photo,
            'value' => $price,
            'status' => 0,
            'pay' => $pay ?? null,
        ];

        $verify = $this->VerifyPurchased($id_photo);
        if($verify){
            $this->UpdatePhotoSold($id_photo, $data);
            return $this->getById($id_photo);
        }
    
        return $this->PhotoSoldRepository->insert($data);
    }

}
