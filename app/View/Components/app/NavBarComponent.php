<?php
 
namespace App\View\Components\app;

use App\Models\Notifications;
use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
 
class NavBarComponent extends Component
{
    public function __construct(
    ) {}
 
    public function render(): View
    {
        $notifications = new Notifications;
        $comments = $notifications->CommentsNotifications();
        $messages = $notifications->MessagesNotifications();
        $support = $notifications->SupportNotifications();
        $number = count($comments) + count($support);

        // remove notification comments
        if(Route::currentRouteName() == 'post'){
            foreach($comments as $key => $comment){
                if($comment['id'] == request()->route('id')){
                    unset($comments[$key]);
                    $number = $number - 1;
                }
            }
        }
        
        return view('app.components.NavBar', ['comments' => $comments, 'number' => $number, 'messages' => $messages, 'support' => $support]);
    }
}