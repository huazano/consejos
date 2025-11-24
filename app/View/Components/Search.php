<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Search extends Component
{
    public $placeholder;
    public $model;
    public $debounce;
    public function __construct($placeholder = 'Buscar...', $model = 'search', $debounce = '500')
    {
        $this->placeholder = $placeholder;
        $this->model = $model;
        $this->debounce = $debounce;
    }

    public function render()
    {
        return view('components.search');
    }
}
