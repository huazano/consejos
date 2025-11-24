<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Alert extends Component
{
    public $name;
    public $icon;
    public $color;

    public function __construct($name = '', $icon = 'fas fa-check', $color = 'green')
    {
        $this->name = $name;
        $this->icon = $icon;
        $this->color = $color;
    }

    public function render()
    {
        return view('components.alert');
    }
}
