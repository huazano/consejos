<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $icon;
    public $color;
    public $footer;
    public $px;
    public $py;

    public function __construct($title = null, $footer = null, $icon = null, $color = 'gray', $px = '5', $py = '3')
    {
        $this->title = $title;
        $this->footer = $footer;
        $this->icon = $icon;
        $this->color = $color;
        $this->px = $px;
        $this->py = $py;
    }

    public function render()
    {
        return view('components.card');
    }
}
