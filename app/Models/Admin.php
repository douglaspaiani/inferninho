<?php

namespace App\Models;

use App\Repositories\AdminRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $table = 'admins';
    use HasFactory;

    protected $AdminRepository;

    public function __construct()
    {
        $this->AdminRepository = new AdminRepository;
    }

    public function GetCreators(){
        return $this->AdminRepository->GetCreators();
    }

    public function GetSubscribers(){
        return $this->AdminRepository->GetSubscribers();
    }

    public function GetSubscribersByUser(int $id){
        return $this->AdminRepository->GetSubscribersByUser($id);
    }

    public function CountSubscribers(int $id){
        return $this->AdminRepository->CountSubscribers($id);
    }
}
