<?php

namespace App\Models;

use App\Repositories\GiftsRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Gifts extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'subscriber',
        'post',
        'value',
        'pay',
        'status',
        'private',
        'view',
        'message'
    ];

    protected $GiftsRepository;

    public function __construct()
    {
        $this->GiftsRepository = new GiftsRepository;
    }

    public function getById(int $id):Gifts
    {
        return $this->GiftsRepository->getById($id);
    }

    public function VerifyPurchased(int $id){
        return $this->GiftsRepository->VerifyPurchased($id);
    }

    public function UpdateGift(int $id, array $data){
        return $this->GiftsRepository->UpdateGift($id, $data);
    }

    public function NewGift(int $id_creator, int $id_photo, float $value, int $private, string $message, string $pay = null){
        
        $data = [
            'user' => $id_creator,
            'subscriber' => Auth::id(),
            'post' => $id_photo,
            'value' => $value,
            'status' => 0,
            'private' => $private,
            'message' => $message,
            'pay' => $pay ?? null,
        ];

        $verify = $this->VerifyPurchased($id_photo);
        if($verify){
            $this->UpdateGift($id_photo, $data);
            return $this->getById($id_photo);
        }
    
        return $this->GiftsRepository->insert($data);
    }

    public function getAll(){
        return $this->GiftsRepository->getAll();
    }
}
