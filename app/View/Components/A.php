<?php

namespace App\View\Components;

use Illuminate\View\Component;

class A extends Component
{
    public $href;
    public $color;
    public $target;
    public $class;
    public $download;

    public function __construct($href = '', $target = null, $color = 'red', $class = '', $download = false)
    {
        $this->href = $href;
        $this->target = $target;
        $this->color = $color;
        $this->class = $class;
        $this->download = $download;
    }

    public function render()
    {
        return view('components.a');
    }
}
