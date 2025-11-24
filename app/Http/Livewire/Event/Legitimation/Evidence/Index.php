<?php

namespace App\Http\Livewire\Event\Legitimation\Evidence;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Event;
use App\Models\Event\Evidence;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Index extends Component
{

    public $event;
    public $search;
    public $listeners = ['confirmDelete'];

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function delete(Evidence $evidence)
    {
        $this->emit(
            'alert_confirmation',
            [
                'title' => '¿Realmente deseas eliminar la evidencia <span class="text-red-600 font-bold">' . $evidence->name . '</span>?',
                'word' => 'SI',
                'emitTo' => 'event.legitimation.evidence.index',
                'callback' => 'confirmDelete',
                'id' => $evidence->id
            ]
        );
    }

    public function confirmDelete(Evidence $evidence)
    {
        $evidence->status = "eliminada";
        $evidence->save();
        $this->emit('alert', 'La evidencia <span class="text-red-600 font-bold">' . $evidence->name . '</span> fue eliminada exitosamente');
    }

    public function render()
    {
        if (auth()->user()->permission->name == "Administrator" || auth()->user()->permission->name == "Jurídico Global") {
            $locations = $this->event->locations()->where('name', 'like', "%$this->search%")->orderBy(DB::raw('ABS(name)'), 'ASC')->get();
        } else {
            $locations = $this->event->locations()->whereHas('users', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })->where('name', 'like', "%$this->search%")->orderBy(DB::raw('ABS(name)'), 'ASC')->get();
        }
        return view('livewire.event.legitimation.evidence.index', compact('locations'));
    }
}
