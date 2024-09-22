<?php
 
namespace App\View\Components\app;

use Illuminate\View\Component;
use Illuminate\View\View;
 
class CreditCardComponent extends Component
{
    public function __construct(
        public string $number,
        public string $valid,
        public string $brand,
        public int $id
    ) {}
 
    public function render(): View
    {
        $final = explode(' ', $this->number);
        return view('app.components.profile.CreditCardComponent', ['final' => $final[3]]);
    }
}