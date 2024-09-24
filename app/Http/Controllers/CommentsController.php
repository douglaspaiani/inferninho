<?php

namespace App\Http\Controllers;

use App\Models\Comments;
use Exception;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    public function PostComment(int $id, Request $request){
        try {
            $comment = new Comments;
            $comment->NewComment($id, $request);
            return redirect()->route('post', ['id' => $id])->with(['success' => 'Seu comentário foi postado!']);
        } catch (Exception $e){
            return redirect()->route('post', ['id' => $id])->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function EditComment(int $id, Request $request){
        try {
            $comment = new Comments;
            $comment->EditComment($id, $request);
            return response()->json([]);
        } catch (Exception $e){
            return redirect()->route('post', ['id' => $id])->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function DeleteComment(int $id){
        $comment = new Comments;
        $comment->DeleteComment($id);
        return true;
    }
}
