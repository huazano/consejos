<?php

namespace App\View\Components\Layout\General;

use Illuminate\View\Component;

class Breadcrumbs extends Component
{
    public function __construct()
    {
    }

    public function render()
    {
        return view('components.layout.general.breadcrumbs');
    }
}
