<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ChatController extends Controller
{
    public function MessagesPage(){
        $message = new Message();
        $messages = $message->ListMessageUsers();
        return view('app.messages', ['view' => $messages['view'], 'notview' => $messages['notview']]);
    }

    public function ChatPage($username)
    {
        $chat = new Message;
        $user = new User;

        if(is_numeric($username)){
            $datauser = $user->getUserById($username);
        } else {
            $datauser = $user->getUserByUsername($username);
        }

        // verify auth chat
        if(!$chat->VerifyAuthChat($datauser['id'])){
            return redirect()->route('messages');
        }

        $messages = Message::where(function($query) use ($datauser) {
            $query->where('received', Auth::id())
                  ->where('sender', $datauser['id']);
        })->orWhere(function($query) use ($datauser) {
            $query->where('received', $datauser['id'])
                  ->where('sender', Auth::id());
        })->get();

        $chat->MarkRead($datauser['id']);

        return view('app.chat', ['messages' => $messages, 'username' => $username, 'user' => $datauser, 'error' => $error ?? null]);
    }

    public function store(string $username, Request $request)
    {
        $user = new User;
        $message = new Message;

        if(is_numeric($username)){
            $datauser = $username;
        } else {
            $datauser = $user->getIdByUsername($username);
        }

        $return = $message->NewMessage([
            'received' => $datauser,
            'sender' => Auth::id(),
            'message' => $request->message,
        ]);

        return response()->json($return);
    }

    public function Update($username){
        $user = new User;

        if(is_numeric($username)){
            $datauser = $user->getUserById($username);
        } else {
            $datauser = $user->getUserByUsername($username);
        }
        
        $messages = Message::where('received', Auth::id())
        ->where('sender', $datauser['id'])
        ->where('view', 0);

        $return = $messages->get();

        $messages->update(['view' => 1]);

        return response()->json($return);
    }
}
