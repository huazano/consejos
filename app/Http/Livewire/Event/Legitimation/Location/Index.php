<?php

namespace App\Http\Livewire\Event\Legitimation\Location;

use App\Models\Location;
use App\Models\Event;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $event;
    public $locations;

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->locations = $event->locations()->orderBy(DB::raw('ABS(name)'), 'ASC')->get();
    }

    public function save(Location $location, $boletas)
    {
        if (!is_numeric($boletas)) {
            $boletas = 0;
        }
        $location->boletas = $boletas;
        $location->save();
    }

    public function render()
    {
        return view('livewire.event.legitimation.location.index');
    }
}
