<?php

namespace App\Http\Livewire\Event\Legitimation\Votting;

use App\Models\Event;
use Livewire\Component;

class Consolidate extends Component
{
    public $event;

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function render()
    {
        return view('livewire.event.legitimation.votting.consolidate');
    }
}
