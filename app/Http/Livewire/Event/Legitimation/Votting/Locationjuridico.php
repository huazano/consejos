<?php

namespace App\Http\Livewire\Event\Legitimation\Votting;

use App\Models\Event;
use App\Models\Location as DBLocation;

use Livewire\Component;

class Locationjuridico extends Component
{
    public $location;
    public $event;

    public $rules = [
        'location.boletas' => '',
        'location.juridico_emitidos' => '',
        'location.juridico_si' => '',
        'location.juridico_no' => '',
        'location.juridico_validos' => '',
        'location.juridico_nulos' => '',
        'location.juridico_anulados' => '',
        'location.juridico_derecho' => '',
    ];

    public function mount(Event $event, DBLocation $location)
    {
        $this->location = $location;
        $this->event = $event;
    }

    public function save()
    {
        $this->validate([
            'location.boletas' => 'required|numeric|min:0',
            'location.juridico_emitidos' => 'required|numeric|min:0',
            'location.juridico_si' => 'required|numeric|min:0',
            'location.juridico_no' => 'required|numeric|min:0',
            'location.juridico_validos' => 'required|numeric|min:0',
            'location.juridico_nulos' => 'required|numeric|min:0',
            'location.juridico_anulados' => 'required|numeric|min:0',
            'location.juridico_derecho' => 'required|numeric|min:0',
        ]);
        $this->location->save();
        $this->emit('alert', 'El resultado parcial fue guardado exitosamente.');
    }

    public function render()
    {
        return view('livewire.event.legitimation.votting.locationjuridico');
    }
}
