<?php

namespace App\Http\Livewire\Event\Legitimation\Votting;

use App\Models\Event;
use App\Models\Location as DBLocation;
use Livewire\Component;

class Location extends Component
{
    public $location;
    public $event;

    public $rules = [
        'location.boletas' => '',
        'location.emitidos' => '',
        'location.si' => '',
        'location.no' => '',
        'location.validos' => '',
        'location.nulos' => '',
        'location.anulados' => '',
        'location.derecho' => ''
    ];

    public function mount(Event $event, DBLocation $location)
    {
        if (auth()->user()->permission->name != "Administrator" && auth()->user()->permission->name != "Jurídico Global") {
            if (!auth()->user()->locations()->find($location->id)) {
                abort(404);
            }
        }
        $this->location = $location;
        $this->event = $event;
    }

    public function save()
    {
        $this->validate([
            'location.boletas' => 'required|numeric|min:0',
            'location.emitidos' => 'required|numeric|min:0',
            'location.si' => 'required|numeric|min:0',
            'location.no' => 'required|numeric|min:0',
            'location.validos' => 'required|numeric|min:0',
            'location.nulos' => 'required|numeric|min:0',
            'location.anulados' => 'required|numeric|min:0',
            'location.derecho' => 'required|numeric|min:0'
        ]);
        $this->location->save();
        $this->emit('alert', 'El resultado parcial fue guardado exitosamente.');
    }

    public function render()
    {
        return view('livewire.event.legitimation.votting.location');
    }
}
