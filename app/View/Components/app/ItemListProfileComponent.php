<?php
 
namespace App\View\Components\app;

use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Illuminate\View\Component;
use Illuminate\View\View;
 
class ItemListProfileComponent extends Component
{
    public function __construct(
        public string $name,
        public string $photo,
        public string $user,
        public $dueDate,
        public int $verify,
        public int $top,
        public int $renew,
        public int $id,
        public int $status
    ) {}
 
    public function render(): View
    {
        // verify photo exists
        if(!empty($this->photo)){
            if(!filter_var($this->photo, FILTER_VALIDATE_URL)){
                $this->photo = env('PROFILE_IMG').$this->photo;
            }
        } else {
            $this->photo = URL::asset('app/images/user-default.jpg');
        }
        $this->dueDate = Carbon::parse($this->dueDate)->format('d/m/Y');
        return view('app.components.profile.ItemListProfileComponent');
    }
}