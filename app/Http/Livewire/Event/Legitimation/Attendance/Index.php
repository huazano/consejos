<?php

namespace App\Http\Livewire\Event\Legitimation\Attendance;

use App\Models\Event;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class Index extends Component
{
    public $event;

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function render()
    {
        if (auth()->user()->permission->name == "Administrator" || auth()->user()->permission->name == "Jurídico Global") {
            $user_locations = $this->event->locations()->get();
        } else {
            $user_locations = $this->event->locations()->whereHas('users', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
        }
        return view('livewire.event.legitimation.attendance.index', compact('user_locations'));
    }
}
