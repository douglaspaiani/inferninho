<?php 

namespace App\Repositories;

use App\Models\Message;
use Illuminate\Support\Facades\Auth;

class MessagesRepository {

    public function MessagesNotifications(){
        return Message::join('users', 'messages.sender', '=', 'users.id')
        ->where('messages.received', Auth::id())
        ->where('messages.view', 0)
        ->select('users.id')
        ->distinct()
        ->count('users.id');
    }

}