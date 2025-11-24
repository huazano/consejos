<?php

namespace App\Http\Livewire\Event\Legitimation;

use App\Models\Event;
use Livewire\Component;

class Create extends Component
{
    public $year;
    public $revision;
    public $startDate;
    public $endDate;

    protected $rules = [
        'year'      => 'required|numeric|min:2020|max:2050',
        'revision'  => 'required|numeric|min:1|max:10',
        'startDate' => 'required|date',
        'endDate'   => 'required|date|after_or_equal:startDate'
    ];

    public function create()
    {
        $this->validate();
        $event = new Event();
        $event->eventtype_id = env('LEGITIMACION', 1);
        $event->name = 'Legitimación del contrato colectivo de trabajo ' . $this->year . ' - Revisión #' . $this->revision;
        $event->start_date = $this->startDate;
        $event->end_date = $this->endDate;
        $event->save();
        $this->emit('alert', 'Evento creado exitosamente.');
    }

    public function render()
    {
        return view('livewire.event.legitimation.create');
    }
}
