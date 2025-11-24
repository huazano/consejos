<?php

namespace App\Http\Livewire\Event\Legitimation\Statistics;

use App\Models\Location;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $event;
    public $search;

    public $listeners = ['acceptLlegada', 'acceptApertura', 'acceptCierre', 'acceptConteo'];

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function llegada(Location $location)
    {
        $this->emit('alert_date', ['title' => '¿A qué hora llego el verificador?', 'word' => 'si', 'emitTo' => 'event.legitimation.statistics.index', 'callback' => 'acceptLlegada', 'id' => $location->id]);
    }

    public function acceptLlegada($data)
    {
        $location = Location::find($data[1]);
        $location->llegada_verificador = $data[0];
        $location->save();
        $this->emit('alert', 'La hora de llegada del verificador fue actualizada exitosamente.');
    }

    public function apertura(Location $location)
    {
        $this->emit('alert_date', ['title' => '¿A qué hora se inicio el acceso a los votantes?', 'word' => 'si', 'emitTo' => 'event.legitimation.statistics.index', 'callback' => 'acceptApertura', 'id' => $location->id]);
    }

    public function acceptApertura($data)
    {
        $location = Location::find($data[1]);
        $location->apertura = $data[0];
        $location->save();
        $this->emit('alert', 'La hora de apertura de la sede fue actualizada exitosamente.');
    }

    public function cierre(Location $location)
    {
        $this->emit('alert_date', ['title' => '¿A qué cerró la sede para acceso a los votantes?', 'word' => 'si', 'emitTo' => 'event.legitimation.statistics.index', 'callback' => 'acceptCierre', 'id' => $location->id]);
    }

    public function acceptCierre($data)
    {
        $location = Location::find($data[1]);
        $location->cierre = $data[0];
        $location->save();
        $this->emit('alert', 'La hora de llegada del cierre fue actualizada exitosamente.');
    }

    public function conteo(Location $location)
    {
        $this->emit('alert_date', ['title' => '¿A qué hora llego el verificador?', 'word' => 'si', 'emitTo' => 'event.legitimation.statistics.index', 'callback' => 'acceptConteo', 'id' => $location->id]);
    }

    public function acceptConteo($data)
    {
        $location = Location::find($data[1]);
        $location->conteo = $data[0];
        $location->save();
        $this->emit('alert', 'La hora de llegada del verificador fue actualizada exitosamente.');
    }



    public function render(Location $location)
    {
        if (auth()->user()->permission->name == "Administrator" || auth()->user()->permission->name == "Jurídico Global") {
            $locations = $this->event->locations()->where('name', 'like', "%$this->search%")->orderBy(DB::raw('ABS(name)'), 'ASC')->get();
        } else {
            $locations = $this->event->locations()->whereHas('users', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })->where('name', 'like', "%$this->search%")->orderBy(DB::raw('ABS(name)'), 'ASC')->get();
        }
        return view('livewire.event.legitimation.statistics.index', compact('locations'));
    }
}
