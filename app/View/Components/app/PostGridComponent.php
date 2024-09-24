<?php
 
namespace App\View\Components\app;

use App\Models\Comments;
use App\Models\Posts;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;
use Illuminate\View\View;
 
class PostGridComponent extends Component
{
    public $link;

    public function __construct(
        public string $image,
        public int $id,
        public int $private
    ) {}
 
    public function render(): View
    {

        // verify images
        if(!empty($this->image)){
            $images = unserialize($this->image);
        }

        return view('app.components.post.PostGridComponent', ['image_post' => env('PHOTO_URL').$images[0]]);
    }
}