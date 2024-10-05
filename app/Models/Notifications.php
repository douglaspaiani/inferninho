<?php

namespace App\Models;

use App\Repositories\CommentRepository;
use App\Repositories\MessagesRepository;
use App\Repositories\SupportRepository;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    protected $CommentRepository;
    protected $MessagesRepository;
    protected $SupportRepository;

    public function __construct()
    {
        $this->CommentRepository = new CommentRepository;
        $this->MessagesRepository = new MessagesRepository;
        $this->SupportRepository = new SupportRepository;
    }
    public function CommentsNotifications(){
        return $this->CommentRepository->CommentsNotifications();
    }

    public function MessagesNotifications(){
        return $this->MessagesRepository->MessagesNotifications();
    }

    public function SupportNotifications(){
        return $this->SupportRepository->SupportNotifications();
    }
}
