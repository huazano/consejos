<?php

namespace App\Http\Livewire\Event\Legitimation\Attendance;

use App\Models\Door;
use App\Models\User;
use App\Models\Location;
use App\Models\AttendanceHistory;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class Screen extends Component
{
    public $door;
    public $user = null;
    public $qr_code;
    public $message = '';
    public $messageType = ''; // 'entry' o 'exit'
    public $registeredTime = '';

    public $listeners = [
        'acceptVisit'
    ];

    public function get_user($qr_code)
    {
        $this->user = null;
        $user = $this->door->location->event->guests()->where('qr', str_replace("'", '-', $qr_code))->first();
        if (!$user) {
            $user = $this->door->location->event->guests()->where('username', str_replace("'", '-', $qr_code))->first();
        }

        if (!$user) {
            $this->emit('alert', ['El código QR es incorrecto o el trabajador no se encuentra registrado en el padrón.', 'error']);
            $this->qr_code = '';
            return;
        }

        // Verificar el último registro de asistencia del usuario en este evento
        $lastAttendance = AttendanceHistory::where('event_id', $this->door->location->event->id)
            ->where('user_id', $user->id)
            ->orderBy('registered_at', 'desc')
            ->first();

        // Determinar si el usuario está dentro o fuera del evento
        $isInside = $lastAttendance && $lastAttendance->type === 'entry';

        // Registrar la entrada o salida directamente
        $this->registerAttendance($user, $isInside);

        $this->qr_code = '';
    }

    public function acceptVisit(User $user)
    {
        $user = $this->door->location->event->guests()->where('users.id', $user->id)->first();
        if ($user) {
            // Verificar el último registro para determinar si es entrada o salida
            $lastAttendance = AttendanceHistory::where('event_id', $this->door->location->event->id)
                ->where('user_id', $user->id)
                ->orderBy('registered_at', 'desc')
                ->first();

            $isInside = $lastAttendance && $lastAttendance->type === 'entry';
            $this->registerAttendance($user, $isInside);
        }
    }

    protected function registerAttendance(User $user, bool $isInside)
    {
        // Determinar el tipo de registro (entrada o salida)
        $type = $isInside ? 'exit' : 'entry';
        $now = Carbon::now();

        // Crear el registro en el historial
        AttendanceHistory::create([
            'event_id' => $this->door->location->event->id,
            'user_id' => $user->id,
            'location_id' => $this->door->location->id,
            'door_id' => $this->door->id,
            'type' => $type,
            'registered_at' => $now
        ]);

        // Actualizar la tabla pivot con la última ubicación de asistencia
        $user->pivot->attendance_door_id = $this->door->id;
        $user->pivot->attendance_location_id = $this->door->location->id;
        $user->pivot->attendance_date = $now;
        $user->pivot->update();

        // Configurar el usuario y mensaje para mostrar en la vista
        $this->user = $user;
        $this->messageType = $type;
        $this->registeredTime = $now->format('H:i:s');

        if ($type === 'entry') {
            $this->message = '¡Bienvenido al evento!';
        } else {
            $this->message = '¡Hasta luego!';
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
