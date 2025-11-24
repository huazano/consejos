<?php

namespace App\Http\Livewire\Event\Legitimation\Votting;

use Livewire\Component;

class Juridico extends Component
{
    public $event;

    public function mount($event)
    {
        $this->event = $event;
    }

    public function render()
    {
        return view('livewire.event.legitimation.votting.juridico');
    }
}
