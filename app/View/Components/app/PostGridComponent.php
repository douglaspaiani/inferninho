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
 
class PostGridComponent extends Component
{
    public $link;

    public function __construct(
        public string $image,
        public int $id,
        public int $private,
    ) {}
 
    public function render(): View
    {

        // verify images
        if(!empty($this->image)){
            $images = unserialize($this->image);
        }

        // verify photo purchased
        $purchased = new PhotosSold;
        $sold = 0;
        if($this->private == 1){
            if($purchased->VerifyPurchased($this->id) == true){
                $sold = 1;
            }
        }

        return view('app.components.post.PostGridComponent', ['image_post' => env('PHOTO_URL').$images[0], 'sold' => $sold]);
    }
}