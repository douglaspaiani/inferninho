<?php
 
namespace App\View\Components\app;

use App\Models\Notifications;
use Illuminate\View\Component;
use Illuminate\View\View;
use Illuminate\Support\Facades\Route;
 
class NavBarNoLoggingComponent extends Component
{
    public function __construct(
    ) {}
 
    public function render(): View
    {
        return view('app.components.NavBarNoLogging');
    }
}