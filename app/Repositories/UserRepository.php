<?php 

namespace App\Repositories;

use App\Models\User;

class UserRepository {

    public function Register(array $data){
        return User::create($data);
    }

    public function find(int $id){
        return User::find($id);
    }
}