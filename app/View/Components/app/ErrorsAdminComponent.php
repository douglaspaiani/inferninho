<?php
 
namespace App\View\Components\app;
 
use Illuminate\View\Component;
use Illuminate\View\View;
 
class ErrorsAdminComponent extends Component
{
    public function __construct(
    ) {}
 
    public function render(): View
    {
        return view('admin.components.errors');
    }
}