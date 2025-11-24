<?php

namespace App\View\Components;

use Illuminate\View\Component;

class CardImage extends Component
{
    public $image;
    public function __construct($image)
    {
        $this->image = $image;
    }

    public function render()
    {
        return view('components.card-image');
    }
}
