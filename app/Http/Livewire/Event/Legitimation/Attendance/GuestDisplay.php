<?php

namespace App\Http\Livewire\Event\Legitimation\Attendance;

use App\Models\Event;
use Livewire\Component;

class GuestDisplay extends Component
{
    public $event;
    public $currentPage = 0;
    public $guestsPerPage = 4;

    public function mount(Event $event)
    {
        if (auth()->user()->permission->name != "Administrator" && auth()->user()->permission->name != "Jurídico Global") {
            // Verificar que el usuario tenga acceso a alguna ubicación del evento
            $hasAccess = false;
            foreach ($event->locations as $location) {
                if (auth()->user()->locations()->find($location->id)) {
                    $hasAccess = true;
                    break;
                }
            }
            if (!$hasAccess) {
                abort(404);
            }
        }
        $this->event = $event;
    }

    public function nextPage()
    {
        $totalGuests = $this->event->guests()->where('is_member', true)->count();
        $totalPages = ceil($totalGuests / $this->guestsPerPage);

        $this->currentPage = ($this->currentPage + 1) % $totalPages;
    }

    public function render()
    {
        $guests = $this->event->guests()
            ->where('is_member', true)
            ->skip($this->currentPage * $this->guestsPerPage)
            ->take($this->guestsPerPage)
            ->get();

        return view('livewire.event.legitimation.attendance.guest-display', [
            'guests' => $guests
        ]);
    }
}
