<?php

namespace App\Http\Livewire\Event\Legitimation\Attendance;

use App\Models\Door;
use App\Models\User;
use App\Models\Location;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;

class Screen extends Component
{
    public $door;
    public $user = null;
    public $qr_code;

    public $listeners = [
        'acceptVisit'
    ];

    public function get_user($qr_code)
    {
        $this->user = null;
        $user = $this->door->location->event->guests()->where('qr', str_replace("'", '-', $qr_code))->first();
        if (!$user) {
            $user = $this->door->location->event->guests()->where('username', str_replace("'", '-', $qr_code))->first();
            if (!$user) {
                $this->emit('alert', ['El código QR es incorrecto o el trabajador no se encuentra registrado en el padrón.', 'error']);
            } else {
                if ($user->pivot->attendance_door_id != null) {
                    if ($user->pivot->attendance_door_id == $this->door->id) {
                        $this->emit('alert', ['<img class="w-16 h-16 mx-auto" src="' . Storage::url($user->profile_photo_path) . '">' . '<b>' . $user->name . '</b><br /> Ya acudió a votar en:<br /> <b class="text-red-600">Esta sede</b>', 'warning']);
                    } else {
                        $visitedLocation = Location::find($user->pivot->attendance_location_id);
                        $this->emit('alert', ['<img class="w-16 h-16 mx-auto" src="' . Storage::url($user->profile_photo_path) . '">' . '<b>' . $user->name . '</b><br /> Ya acudió a votar en:<br /> <b class="text-red-600">' . $visitedLocation->name . '</b>', 'warning']);
                    }
                } else {
                    if ($user->pivot->door_id == $this->door->id) {
                        $this->acceptVisit($user);
                        // $this->emit('alert_confirmation', ['title' => '<img class="w-16 h-16 mx-auto" src="' . Storage::url($user->profile_photo_path) . '">' . '<b>' . $user->name . '</b><br /> ¿El trabajador cuenta con Identifiación Oficial?', 'word' => 'si', 'emitTo' => 'event.legitimation.attendance.screen', 'callback' => 'acceptVisit', 'id' => $user->id]);
                    } else {
                        $this->emit('alert_confirmation', ['title' => '<img class="w-16 h-16 mx-auto" src="' . Storage::url($user->profile_photo_path) . '">' . $user->name . '<br /> <b class="font-bold text-red-600">NO PERTENECE</b> a esta sede.<br />¿Se le permitirá votar en esta sede?', 'word' => 'si', 'emitTo' => 'event.legitimation.attendance.screen', 'callback' => 'acceptVisit', 'id' => $user->id]);
                    }
                }
            }
        } else {
            if ($user->pivot->attendance_door_id != null) {
                if ($user->pivot->attendance_door_id == $this->door->id) {
                    $this->emit('alert', ['<img class="w-16 h-16 mx-auto" src="' . Storage::url($user->profile_photo_path) . '">' . '<b>' . $user->name . '</b><br /> Ya acudió a votar en:<br /> <b class="text-red-600">Esta sede</b>', 'warning']);
                } else {
                    $visitedLocation = Location::find($user->pivot->attendance_location_id);
                    $this->emit('alert', ['<img class="w-16 h-16 mx-auto" src="' . Storage::url($user->profile_photo_path) . '">' . '<b>' . $user->name . '</b><br /> Ya acudió a votar en:<br /> <b class="text-red-600">' . $visitedLocation->name . '</b>', 'warning']);
                }
            } else {
                if ($user->pivot->door_id == $this->door->id) {
                    $this->acceptVisit($user);
                    // $this->emit('alert_confirmation', ['title' => '<img class="w-16 h-16 mx-auto" src="' . Storage::url($user->profile_photo_path) . '">' . '<b>' . $user->name . '</b><br /> ¿El trabajador cuenta con Identifiación Oficial?', 'word' => 'si', 'emitTo' => 'event.legitimation.attendance.screen', 'callback' => 'acceptVisit', 'id' => $user->id]);
                } else {
                    $this->emit('alert_confirmation', ['title' => '<img class="w-16 h-16 mx-auto" src="' . Storage::url($user->profile_photo_path) . '">' . $user->name . '<br /> <b class="font-bold text-red-600">NO PERTENECE</b> a esta sede.<br />¿Se le permitirá votar en esta sede?', 'word' => 'si', 'emitTo' => 'event.legitimation.attendance.screen', 'callback' => 'acceptVisit', 'id' => $user->id]);
                }
            }
        }
        $this->qr_code = '';
    }

    public function acceptVisit(User $user)
    {
        $user = $this->door->location->event->guests()->where('users.id', $user->id)->first();
        if ($user) {
            $user->pivot->attendance_door_id = $this->door->id;
            $user->pivot->attendance_location_id = $this->door->location->id;
            $user->pivot->update();
            $this->user = $user;
        }
    }

    public function mount(Door $door)
    {
        if (auth()->user()->permission->name != "Administrator" && auth()->user()->permission->name != "Jurídico Global") {
            if (!auth()->user()->locations()->find($door->location_id)) {
                abort(404);
            }
        }
        $this->door = $door;
    }

    public function render()
    {
        return view('livewire.event.legitimation.attendance.screen');
    }
}
