<?php 

namespace App\Repositories;

use App\Models\Comments;
use App\Models\Posts;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CommentRepository {

    public function NewComment(array $data){
        return Comments::create($data);
    }

    public function update(array $data){
        return Comments::find($data['id'])->update($data);
    }

    public function delete(int $id){
        $comment = Comments::find($id);
        if($comment->subscriber == Auth::id() || $comment->user == Auth::id()){
            $comment->delete();
        }
        return $comment;
    }

    public function getCommentsByPost(int $id){
        $comments = DB::table('comments')
        ->join('users', 'comments.subscriber', '=', 'users.id')
        ->where('comments.post', $id)
        ->select('comments.id', 'comments.user', 'comments.view', 'comments.comment', 'comments.subscriber', 'comments.created_at', 'users.name', 'users.photo', 'users.username', 'users.verify', 'users.top', 'users.creator', 'users.hidden_name')
        ->orderBy('comments.id', 'desc')
        ->get();

        return $comments;
    }

    public function countComments(int $id){
        return Comments::where('post', $id)->count();
    }

    public function Notifications(){
        $posts = Posts::select('posts.description', 'posts.id', DB::raw('SUBSTRING(posts.description, 1, 20) as description'))
        ->withCount(['comments' => function ($query) {
            $query->whereColumn('posts.id', 'comments.post')
                  ->where('comments.view', 0);
        }])
        ->whereHas('comments', function ($query) {
            $query->where('comments.view', 0);
            $query->where('comments.subscriber', '!=', Auth::id());
        })
        ->get();

        return $posts;
    }

    public function ReadComments(int $id):void
    {
        Comments::where('post', $id)->update(['view' => 1]);
    }

}