<?php
 
namespace App\View\Components\app;
 
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
        public float $likes,
        public int $id,
        public int $top,
        public int $verify
    ) {}
 
    public function render(): View
    {
        $this->photo = env('PROFILE_IMG').$this->photo;
        $this->image = env('POST_IMG').$this->image;
        return view('app.components.home.PostComponent');
    }
}