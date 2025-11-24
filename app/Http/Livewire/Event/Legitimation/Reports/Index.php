<?php

namespace App\Http\Livewire\Event\Legitimation\Reports;

use App\Models\Coordination;
use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class Index extends Component
{
    public $event;
    public $coordinations;
    public $view = 'status';

    public function display($view)
    {
        $this->view = $view;
    }

    public function mount(Event $event)
    {
        $this->event = $event;
        $this->coordinations = Coordination::get();
    }

    public function render()
    {
        if (auth()->user()->permission->name == "Administrator" || auth()->user()->permission->name == "Jurídico Global") {
            $locations = $this->event->fresh()->locations()->orderBy(DB::raw('ABS(name)'), 'ASC')->get();
        } else {
            $locations = $this->event->fresh()->locations()->whereHas('users', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })->orderBy(DB::raw('ABS(name)'), 'ASC')->get();
        }
        return view('livewire.event.legitimation.reports.index', compact('locations'));
    }
}
