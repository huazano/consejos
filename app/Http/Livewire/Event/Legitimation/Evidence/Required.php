<?php

namespace App\Http\Livewire\Event\Legitimation\Evidence;

use App\Models\Location;
use App\Models\Event;
use App\Models\Event\Evidence;
use App\Models\Event\Evidencetype;
use Livewire\Component;

class Required extends Component
{
    public $event;
    public $location;
    public $types;
    public $name;
    public $limit;
    public $type = "none";

    public function mount(Event $event, $location)
    {
        $this->event = $event;
        $this->location = Location::find($location);
        $this->types = Evidencetype::get();
    }

    public function save()
    {
        $this->validate([
            'name' => 'required|min:5|max:255',
            'type' => 'required|exists:evidencetypes,id',
            'limit' => 'required|date|after_or_equal:today'
        ]);

        if ($this->location) {
            Evidence::create([
                'event_id' => $this->event->id,
                'location_id' => $this->location->id,
                'evidencetype_id' => $this->type,
                'name' => $this->name,
                'limit_date' => $this->limit
            ]);
        } else {
            foreach ($this->event->locations as $location) {
                Evidence::create([
                    'event_id' => $this->event->id,
                    'location_id' => $location->id,
                    'evidencetype_id' => $this->type,
                    'name' => $this->name,
                    'limit_date' => $this->limit
                ]);
            }
        }
        $this->emit('alert', 'La solicitud de evidencia fue agregada exitosamente.');
    }

    public function render()
    {
        return view('livewire.event.legitimation.evidence.required');
    }
}
