<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessPosts;
use App\Models\Comments;
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
        return view('app.newPost', ['user'=>$user]);
    }

    public function EditPostPage(int $id){
        $user = new User();
        $post = new Posts;
        $user = $user->getUser();
        return view('app.editPost', ['user'=>$user, 'post' => $post->getPost($id)]);
    }

    public function EditPost(int $id, Request $request){

        try {
            // add to queue posts
            $post = new Posts();
            $post->EditPost($id, $request);
            return redirect()->route('post', ['id' => $id])->with(['success' => 'Descrição alterada com sucesso!']);

        } catch (Exception $e){

            return redirect()->route('post', ['id' => $id])->withErrors(['error' => $e->getMessage()]);

        }
    }

    public function PostPage(int $id){
        $post = new Posts;
        $comments = new Comments;
        return view('app.post', ['post'=>$post->getPost($id), 'comments' => $comments->getCommentsByPost($id)]);
    }

    public function DeletePost(int $id){
        $post = new Posts;
        $post->DeletePost($id);
        return response()->json([]);
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
