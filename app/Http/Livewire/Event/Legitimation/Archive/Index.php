<?php

namespace App\Http\Livewire\Event\Legitimation\Archive;

use App\Models\Event;
use App\Models\Event\Archive;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $event;

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function delete(Archive $archive)
    {
        if (request()->user()->hasPermission('Jurídico') || request()->user()->hasPermission('Administrator')) {
            $archive->delete();
            $this->emit('alert', 'El archivo fue eliminado exitosamente.');
        }
    }

    public function render()
    {
        if (auth()->user()->permission->name == "Administrator" || auth()->user()->permission->name == "Jurídico Global") {
            $locations = $this->event->locations()->orderBy(DB::raw('ABS(name)'), 'ASC')->get();
        } else {
            $locations = $this->event->locations()->whereHas('users', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })->orderBy(DB::raw('ABS(name)'), 'ASC')->get();
        }
        return view('livewire.event.legitimation.archive.index', compact('locations'));
    }
}
