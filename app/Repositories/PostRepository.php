<?php 

namespace App\Repositories;

use App\Models\Posts;
use Illuminate\Support\Facades\DB;

class PostRepository {

    public function getById(int $id){
        return Posts::find($id);
    }

    public function setPost(array $data){
        return Posts::create($data);
    }

    public function getPostAndUser(){
        $posts = DB::table('posts')
        ->leftJoin('users', 'posts.user', '=', 'users.id')
        ->select('posts.*', 'users.name', 'users.photo', 'users.username', 'users.verify', 'users.top')
        ->orderBy('id', 'desc')
        ->get();

        return $posts;
    }
}