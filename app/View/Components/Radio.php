<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Radio extends Component
{
    public $name;
    public $color;
    public $model;
    public $checked;
    public $value;

    public function __construct($name, $color = 'gray', $model = null, $checked = null, $value = '')
    {
        $this->name = $name;
        $this->color = $color;
        $this->model = $model;
        $this->checked = $checked;
        $this->value = $value;
    }

    public function render()
    {
        return view('components.radio');
    }
}
