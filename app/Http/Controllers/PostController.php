<?php

namespace App\Http\Controllers;

use App\Models\Posts;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function NewPostPage(){
        $user = new User();
        return view('app.newPost', ['user'=>$user->getUser()]);
    }

    public function NewPost(Request $request){
        $post = new Posts();

        try {

            $post->NewPost($request);
            return redirect()->route('home')->with('success', 'Conteúdo publicado com sucesso!');

        } catch (Exception $e){

            return redirect()->route('newPost')->withErrors('error', $e->getMessage());

        }
    }
}
