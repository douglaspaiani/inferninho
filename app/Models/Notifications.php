<?php

namespace App\Models;

use App\Repositories\CommentRepository;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $CommentRepository;

    public function __construct()
    {
        $this->CommentRepository = new CommentRepository;
    }
    public function CommentsNotifications(){
        return $this->CommentRepository->Notifications();
    }
}
