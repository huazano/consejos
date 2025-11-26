<?php

namespace App\Http\Livewire\Event\Legitimation\Attendance;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithPagination;

class AttendanceList extends Component
{
    use WithPagination;

    public $event;
    public $search = '';
    public $filterStatus = 'all'; // all, attended, not_attended

    protected $queryString = ['search', 'filterStatus'];

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function updatingFilterStatus()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = $this->event->guests()
            ->where('is_member', true)
            ->orderBy('name', 'asc');

        if ($this->search) {
            $query->where(function($q) {
                $q->where('name', 'like', '%' . $this->search . '%')
                  ->orWhere('username', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->filterStatus === 'attended') {
            $query->whereNotNull('attendance_door_id');
        } elseif ($this->filterStatus === 'not_attended') {
            $query->whereNull('attendance_door_id');
        }

        $guests = $query->paginate(20);

        $totalMembers = $this->event->guests()->where('is_member', true)->count();
        $attendedMembers = $this->event->guests()->where('is_member', true)->whereNotNull('attendance_door_id')->count();
        $notAttendedMembers = $totalMembers - $attendedMembers;

        return view('livewire.event.legitimation.attendance.attendance-list', [
            'guests' => $guests,
            'totalMembers' => $totalMembers,
            'attendedMembers' => $attendedMembers,
            'notAttendedMembers' => $notAttendedMembers,
        ]);
    }
}
