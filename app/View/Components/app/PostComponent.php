<?php
 
namespace App\View\Components\app;

use Carbon\Carbon;
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

        return view('app.components.home.PostComponent', ['images' => $images, 'photo_url' => $photoUrl]);
    }
}