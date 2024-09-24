<?php
 
namespace App\View\Components\app;

use App\Models\Comments;
use App\Models\PhotosSold;
use App\Models\Posts;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;
use Illuminate\View\View;
 
class PostComponent extends Component
{
    public $link;

    public function __construct(
        public string $name,
        public string $photo,
        public string $user,
        public string $description,
        public string $image,
        public int $likes,
        public int $id,
        public int $top,
        public int $verify,
        public string $date,
        public int $nocomments,
        public float $value,
        public int $public,
        public float $price,
        public int $timer
    ) {}
 
    public function render(): View
    {
        $this->user = str_replace('@', '', $this->user);
        $this->link = env('APP_URL').'/'.$this->user;
        
        // add @ to username
        $this->user = "@".$this->user;

        // verify photo exists
        if(!empty($this->photo)){
            if(!filter_var($this->photo, FILTER_VALIDATE_URL)){
                $this->photo = env('PROFILE_IMG').$this->photo;
            }
        } else {
            $this->photo = URL::asset('app/images/user-default.jpg');
        }

        // verify images
        if(!empty($this->image)){
            $images = unserialize($this->image);
        }

        $photoUrl = env('PHOTO_URL');

        // date posting
        $date = Carbon::parse($this->date);
        $this->date = $date->diffForHumans();

        // comments
        $comment = new Comments;
        $countComments = $comment->countComments($this->id);

        if(Route::currentRouteName() == 'post'){
            $comments = $comment->getCommentsByPost($this->id);
        }

        $post = new Posts;
        $user_id = $post->getIdUserByPost($this->id);

        // desactive notifications
        if(Route::currentRouteName() == 'post' && $user_id == Auth::id()){
            $comment->ReadComments($this->id);
        }

        // verify photo purchased
        $purchased = new PhotosSold;
        $sold = 0;
        if($this->value > 0){
            if($purchased->VerifyPurchased($this->id) == true){
                $sold = 1;
            }
        }
        
        return view('app.components.post.PostComponent', ['sold' => $sold, 'images' => $images, 'photo_url' => $photoUrl, 'comments' => $comments ?? null, 'countComments' => $countComments, 'user_id' => $user_id]);
    }
}