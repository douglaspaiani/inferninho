<?php 

namespace App\Repositories;

use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class PostRepository {

    public function getById(int $id){
        return Posts::find($id);
    }

    public function getPostsByUsername(string $username){
        $id = User::where('username', $username)->first();
        return Posts::where('user', $id->id)->orderBy('id', 'desc')->get();
    }

    public function setPost(array $data){
        return Posts::create($data);
    }

    public function countPosts(string $username){
        return DB::table('posts')
        ->leftJoin('users', 'posts.user', '=', 'users.id')
        ->where('users.username', $username)
        ->whereNotNull('posts.photos')
        ->select('posts.id')
        ->count();
    }

    public function countVideos(string $username){
        return DB::table('posts')
        ->leftJoin('users', 'posts.user', '=', 'users.id')
        ->where('users.username', $username)
        ->whereNotNull('posts.video')
        ->select('posts.id')
        ->count();
    }

    public function countLikes(string $username){
        return DB::table('posts')
        ->leftJoin('users', 'posts.user', '=', 'users.id')
        ->where('users.username', $username)
        ->sum('posts.likes');
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