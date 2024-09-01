<?php
 
namespace App\View\Components\app;

use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;
use Illuminate\View\View;
 
class PostComponent extends Component
{
    public function __construct(
        public string $name,
        public string $photo,
        public string $user,
        public string $description,
        public string $image,
        public int $likes,
        public int $id,
        public int $top,
        public int $verify
    ) {}
 
    public function render(): View
    {
        // add @ to username
        $this->user = "@".$this->user;

        // verify photo exists
        if(!empty($this->photo)){
            $this->photo = env('PROFILE_IMG').$this->photo;
        } else {
            $this->photo = URL::asset('app/images/user-default.jpg');
        }

        // verify images
        if(!empty($this->image)){
            $images = unserialize($this->image);
        }

        $photoUrl = env('PHOTO_URL');

        return view('app.components.home.PostComponent', ['images' => $images, 'photo_url' => $photoUrl]);
    }
}