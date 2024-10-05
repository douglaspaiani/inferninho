<?php
 
namespace App\View\Components\admin;

use App\Models\Support;
use Illuminate\View\Component;
use Illuminate\View\View;
 
class SideBarComponent extends Component
{
    public function __construct(
    ) {}
 
    public function render(): View
    {
        $support = new Support;
        $countSupport = $support->CountSupport();
        return view('admin.components.sidebar', ['countSupport' => $countSupport]);
    }
}