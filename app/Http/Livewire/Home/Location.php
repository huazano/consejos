<?php

namespace App\Http\Livewire\Home;

use Livewire\Component;
use App\Models\Event;
use App\Models\User;
use App\Models\Location as ModelLocation;

class Location extends Component
{
    public $location = false;
    public $user;
    public $username;
    public $event;
    public $message;
    public $user_location;

    public function display_location()
    {
        $this->location = true;
        $this->event = Event::find(11);
        $this->user = User::where('username', $this->username)->first();
        $this->message = '';
        if (!$this->user) {
            $this->location = false;
            $this->user_location = null;
            $this->message = 'El trabajador <span class="font-bold text-red-600">' . $this->username . '</span> no se encuentró en el padrón.';
        } else {
            $this->user_location = ModelLocation::find($this->event->guests()->where('user_id', $this->user->id)->first()->pivot->location_id);
        }
    }

    public function render()
    {
        return view('livewire.home.location');
    }
}
