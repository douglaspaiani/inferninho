<?php 

namespace App\Repositories;

use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserRepository {

    public function Register(array $data){
        return User::create($data);
    }

    public function VerifyCreator():bool
    {
        $user = User::where('id', Auth::id())->get(['creator'])->first();
        if($user->creator == 1){
            return true;
        } else {
            return false;
        }
    }

    public function find(int $id){
        return User::find($id);
    }

    public function Ban(int $id){
        return User::where('id', $id)->update(['ban'=>1]);
    }

    public function Unban(int $id){
        return User::where('id', $id)->update(['ban'=>0]);
    }

    public function search(string $name){
        return User::where('name', 'LIKE', "%{$name}%")
        ->where('creator', 1)
        ->where('ban', 0)
        ->orWhere('username', 'LIKE', "%{$name}%")
        ->limit(6)
        ->orderBy('verify', 'desc')
        ->orderBy('top', 'desc')
        ->get(['name', 'username', 'photo', 'verify', 'top']);
    }

    public function update(array $data){
        return User::find($data['id'])->update($data);
    }

    public function getUserByUsername(string $username){
        return User::where('username', $username)->first();
    }

    public function UserExists(string $username): bool
    {
        if (User::where('username', $username)->count() > 1){
            return true;
        } else {
            return false;
        }
    }

    public function getIdByUsername(string $username){
        $user = User::where('username', $username)->get(['id'])->first();
        return $user['id'];
    }

    public function getBanned(){
        return User::where('ban', 1)->get();
    }
}