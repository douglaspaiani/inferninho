<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Message extends Model
{
    use HasFactory;
    protected $fillable = ['sender', 'message', 'view', 'received'];

    public function NewMessage($data){
        $message = Message::create($data);
        return [
            'message' => $message->message,
            'date' => $message->created_at
        ];
    }

    public function VerifyAuthChat(int $id):bool
    {
        $chat = Subscriptions::where(function($query) use ($id) {
            $query->where('user', Auth::id())
                  ->where('subscriber', $id);
        })->orWhere(function($query) use ($id) {
            $query->where('user', $id)
                  ->where('subescriber', Auth::id());
        })->count();

        if($chat > 0){
            return true;
        } else {
            return false;
        }
    }
}
