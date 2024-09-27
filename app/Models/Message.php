<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['sender', 'message', 'view', 'received'];

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender', 'id');
    }

    public function NewMessage($data){
        $message = Message::create($data);
        return [
            'message' => $message->message,
            'date' => $message->created_at
        ];
    }

    public function VerifyAuthChat(int $id):bool
    {
        if($id == Auth::id()){
            return false;
        }
        
        $chat = Subscriptions::where(function($query) use ($id) {
            $query->where('user', Auth::id())
                  ->where('subscriber', $id);
        })->orWhere(function($query) use ($id) {
            $query->where('user', $id)
                  ->where('subscriber', Auth::id());
        })->where('status', 1)->count();

        if($chat > 0){
            return true;
        } else {
            return false;
        }
    }

    public function ListMessageUsers(){
        $notview = Message::join('users', 'messages.sender', '=', 'users.id')
        ->where('messages.received', Auth::id())
        ->where('messages.view', 0)
        ->select('users.name', 'users.photo', 'users.username', 'users.verify', 'users.top', 'users.id')
        ->distinct();

        $view = Message::join('users', 'messages.sender', '=', 'users.id')
        ->where('messages.received', Auth::id())
        ->where('messages.view', 1)
        ->whereNotIn('users.id', $notview->pluck('users.id'))
        ->select('users.name', 'users.photo', 'users.username', 'users.verify', 'users.top', 'users.id')
        ->distinct();

        return [
            'view' => $view->get(),
            'notview' => $notview->get()
        ];
    }

    public function MarkRead(int $id):void
    {
        Message::where('received', Auth::id())->where('sender', $id)->update(['view' => 1]);
    }
}
