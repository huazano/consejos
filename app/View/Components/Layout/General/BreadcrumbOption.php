<?php

namespace App\View\Components\Layout\General;

use Illuminate\View\Component;

class BreadcrumbOption extends Component
{
    public $name;
    public $route;
    public $arrow;

    public function __construct($name, $route = false, $arrow = 'true')
    {
        $this->name  = $name;
        $this->route = $route;
        $this->arrow = $arrow;
    }

    public function render()
    {
        return view('components.layout.general.breadcrumb-option');
    }
}
