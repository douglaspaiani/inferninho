<?php

namespace App\Models;

use App\Repositories\PhotoSoldRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PhotosSold extends Model
{
    use HasFactory;

    protected $fillable = [
        'user',
        'subscriber',
        'post',
        'value'
    ];

    protected $PhotoSoldRepository;

    public function __construct()
    {
        $this->PhotoSoldRepository = new PhotoSoldRepository;
    }

    public function VerifyPurchased(int $id){
        return $this->PhotoSoldRepository->VerifyPurchased($id);
    }
}
