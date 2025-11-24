<?php

namespace App\Http\Livewire\Event\Legitimation\Credentials;

use App\Http\Livewire\Home\Location;
use Illuminate\Database\Eloquent\Builder;
use App\Models\Event;
use Livewire\Component;
use App\Models\User;

class Index extends Component
{
    public $event;

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function render()
    {
        abort(404);
        if (auth()->user()->permission->name == "Administrator" || auth()->user()->permission->name == "Jurídico Global") {
            $user_locations = $this->event->locations()->get();
        } else {
            $user_locations = $this->event->locations()->whereHas('users', function (Builder $query) {
                $query->where('user_id', auth()->user()->id);
            })->get();
        }
        return view('livewire.event.legitimation.credentials.index', compact('user_locations'));
    }
}
