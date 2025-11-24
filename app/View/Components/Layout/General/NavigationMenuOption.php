<?php

namespace App\View\Components\Layout\General;

use Illuminate\View\Component;

class NavigationMenuOption extends Component
{
    public $route;
    public $icon;
    public $activeRoute;
    public $onclick;

    public function __construct($route = '#', $icon = 'fas fa-home', $activeRoute = 'THE_ROUTE.NAME', $onclick = null)
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->activeRoute = $activeRoute;
        $this->onclick = $onclick;
    }

    public function render()
    {
        return view('components.layout.general.navigation-menu-option');
    }
}
