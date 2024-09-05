<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPosts;
use App\Models\Posts;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;

class PostController extends Controller
{
    public function NewPostPage(){
        $user = new User();
        $user = $user->getUser();
        if(empty($user['photo'])){
            $user['photo'] = URL::asset('app/images/user-default.jpg');
        } else {
            $user['photo'] = env('PROFILE_IMG').$user['photo'];
        }
        return view('app.newPost', ['user'=>$user]);
    }

    public function NewPost(Request $request){

        try {
            // add to queue posts
            $post = new Posts();
            $post->NewPostMedia($request);
            return redirect()->route('home')->with(['success' => 'Conteúdo publicado com sucesso!']);

        } catch (Exception $e){

            return redirect()->route('newPost')->withErrors(['error' => $e->getMessage()]);

        }
    }

    public function Like(Request $request, int $id)
    {
        $post = new Posts();
        $likes = $post->like($id);
        return response()->json(['likes' => $likes]);
    }
}
