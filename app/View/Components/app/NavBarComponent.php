<?php
 
namespace App\View\Components\app;
 
use Illuminate\View\Component;
use Illuminate\View\View;
 
class NavBarComponent extends Component
{
    public function __construct(
    ) {}
 
    public function render(): View
    {
        return view('app.components.NavBar');
    }
}