<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $type;
    public $click;
    public $color;
    public $icon;
    public $href;
    public $class;
    public $target;

    public function __construct($type = 'button', $click = null, $color = 'gray', $icon = null, $href = null, $class = '', $target = '')
    {
        $this->type = $type;
        $this->click = $click;
        $this->color = $color;
        $this->icon = $icon;
        $this->href = $href;
        $this->class = $class;
        $this->target = $target;
    }

    public function render()
    {
        return view('components.button');
    }
}
