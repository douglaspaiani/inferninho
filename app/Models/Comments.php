<?php

namespace App\Models;

use App\Repositories\CommentRepository;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Comments extends Model
{
    use HasFactory;

    protected $fillable = [
        'post',
        'user',
        'subscriber',
        'comment',
        'view'
    ];

    protected $CommentRepository;

    public function __construct()
    {
        $this->CommentRepository = new CommentRepository;
    }

    public function NewComment(int $id, Request $request){
        $post = new Posts;

        //mount data
        $data = [
            'post' => $id,
            'user' => $post->getIdUserByPost($id),
            'subscriber' => Auth::id(),
            'comment' => FormatContent($request->get('comment'))
        ];

        return $this->CommentRepository->NewComment($data);
    }

    public function EditComment(int $id, Request $request){
        $post = new Posts;

        //mount data
        $data = [
            'id' => $id,
            'comment' => FormatContent($request->get('comment'))
        ];

        return $this->CommentRepository->update($data);
    }

    public function DeleteComment(int $id){
        return $this->CommentRepository->delete($id);
    }

    public function getCommentsByPost(int $id){
        return $this->CommentRepository->getCommentsByPost($id);
    }

    public function countComments(int $id){
        return $this->CommentRepository->countComments($id);
    }

    public function ReadComments(int $id):void
    {
        $this->CommentRepository->ReadComments($id);
    }
}
