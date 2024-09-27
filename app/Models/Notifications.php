<?php

namespace App\Models;

use App\Repositories\CommentRepository;
use App\Repositories\MessagesRepository;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $CommentRepository;
    protected $MessagesRepository;

    public function __construct()
    {
        $this->CommentRepository = new CommentRepository;
        $this->MessagesRepository = new MessagesRepository;
    }
    public function CommentsNotifications(){
        return $this->CommentRepository->CommentsNotifications();
    }

    public function MessagesNotifications(){
        return $this->MessagesRepository->MessagesNotifications();
    }
}
