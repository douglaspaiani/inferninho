<?php
 
namespace App\View\Components\app;
 
use Illuminate\View\Component;
use Illuminate\View\View;
 
class ItemListProfileComponent extends Component
{
    public function __construct(
        public string $name,
        public string $photo,
        public string $user,
        public int $verify,
        public int $top,
        public int $id
    ) {}
 
    public function render(): View
    {
        $this->photo = env('PROFILE_IMG').$this->photo;
        return view('app.components.profile.ItemListProfileComponent');
    }
}