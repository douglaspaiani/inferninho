<?php
 
namespace App\View\Components\app;

use App\Models\User;
use Illuminate\View\Component;
use Illuminate\View\View;
 
class NavBarCreatorComponent extends Component
{
    public function __construct(
    ) {}
 
    public function render(): View
    {
        $user = new User;
        if($user->VerifyCreator()){
            return view('app.components.NavBarCreator');
        } else {
            return view('app.components.blank');
        }
        
    }
}