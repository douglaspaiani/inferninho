<?php 

namespace App\Repositories;

use App\Models\User;
use Exception;

class UserRepository {

    public function Register(array $data){
        return User::create($data);
    }
}