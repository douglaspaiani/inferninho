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

    public function update(array $data){
        return User::find($data['id'])->update($data);
    }

    public function UserExists(string $username): bool
    {
        if (User::where('username', $username)->count() > 1){
            return true;
        } else {
            return false;
        }
    }
}