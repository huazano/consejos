<?php

namespace App\Http\Livewire\Event\Legitimation\Doors;

use App\Models\Coordination;
use App\Models\Event;
use Livewire\Component;
use App\Models\Door;

class Index extends Component
{
    public $event;
    public $coordinations;

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->coordinations = Coordination::get();
    }

    public function setCoordination(Door $door, Coordination $coordination)
    {
        $door->coordination_id = $coordination->id;

        $door->save();
        $this->emit('alert', 'echo');
    }

    public function render()
    {
        return view('livewire.event.legitimation.doors.index');
    }
}
