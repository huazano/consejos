<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $label;
    public $model;
    public $defer;
    public $type;
    public $value;

    public function __construct($type, $value = '', $label = '', $model = null, $defer = false)
    {
        $this->value = $value;
        $this->type = $type;
        $this->label = $label;
        $this->model = $model;
        $this->defer = $defer;
    }

    public function render()
    {
        return view('components.input');
    }
}
