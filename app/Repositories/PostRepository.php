<?php 

namespace App\Repositories;

use App\Models\PhotosSold;
use App\Models\Posts;
use App\Models\Subscriptions;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostRepository {

    public function getById(int $id){
        return Posts::find($id);
    }

    public function update(array $data){
        return Posts::find($data['id'])->update($data);
    }

    public function DeletePost(int $id){
        $post = Posts::where('id', $id)->get(['user'])->first();
        if($post['user'] != Auth::id()){
            throw new Exception('Você não tem permissão para apagar esse post.');
        }
        return Posts::find($id)->delete();
    }

    public function getPost(int $id){
        $post = DB::table('posts')
        ->join('users', 'posts.user', '=', 'users.id')
        ->where('posts.id', $id)
        ->select('posts.*', 'users.name', 'users.photo', 'users.username', 'users.verify', 'users.top', 'users.price_1', 'posts.timer')
        ->first();
        return $post;
    }

    public function getPostsByUsername(string $username){
        $id = User::where('username', $username)->first();
        return Posts::where('user', $id->id)->where('public', 0)->orderBy('id', 'desc')->get();
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

    public function getPostsHome(){
        $subs = new Subscriptions();

        $users = $subs->getSubscriptions();

        array_push($users, [0=>Auth::id()]);

        $posts = DB::table('posts')
        ->join('users', 'posts.user', '=', 'users.id')
        ->where('posts.schedule', '<=', Carbon::now()->format('Y-m-d H:i:s'))
        ->where('posts.due_date', '>=', Carbon::now()->format('Y-m-d H:i:s'))
        ->whereIn('posts.user', $users)
        ->orWhere('posts.public', 1)
        ->select('posts.*', 'users.name', 'users.photo', 'users.username', 'users.verify', 'users.top', 'users.price_1', 'posts.timer')
        ->orderBy('posts.id', 'desc')
        ->get();
        
        return $posts;
    }

    public function getIdUserByPost(int $id){
        $post = Posts::where('id', $id)->get(['user'])->first();
        return $post->user;
    }

    public function getPostsPurchased(){
        $posts = PhotosSold::where('subscriber', Auth::id())->pluck('post');
        return Posts::whereIn('id', $posts)->get(['photos', 'id']);
    }
}