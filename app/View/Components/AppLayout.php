<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class AppLayout extends Component
{
    public function __construct(public ?string $header = null) {}

    /** Devuelve la vista del componente */
    public function render(): View
    {
        return view('components.app-layout'); // <-- apunta al blade de componente
    }
}
