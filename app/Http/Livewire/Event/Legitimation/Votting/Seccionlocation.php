<?php

namespace App\Http\Livewire\Event\Legitimation\Votting;

use App\Models\Door;
use Livewire\Component;
use App\Models\Event;
use App\Models\Location as DBLocation;


class Seccionlocation extends Component
{
    public $location;
    public $event;
    public $door;

    public $rules = [
        'door.si' => '',
        'door.no' => '',
        'door.nulos' => '',
    ];

    public function mount(Event $event, DBLocation $location, Door $door)
    {
        if (auth()->user()->permission->name != "Administrator" && auth()->user()->permission->name != "Jurídico Global") {
            if (!auth()->user()->locations()->find($location->id)) {
                abort(404);
            }
        }
        $this->location = $location;
        $this->door = $door;
        $this->event = $event;
    }

    public function save()
    {
        $this->validate([
            'door.si' => 'required|numeric|min:0',
            'door.no' => 'required|numeric|min:0',
            'door.nulos' => 'required|numeric|min:0',
        ]);
        $this->door->save();
        $this->emit('alert', 'El resultado de la sección fue actualizado exitosamente.');
    }

    public function render()
    {
        return view('livewire.event.legitimation.votting.seccionlocation');
    }
}
