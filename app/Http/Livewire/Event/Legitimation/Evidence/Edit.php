<?php

namespace App\Http\Livewire\Event\Legitimation\Evidence;

use App\Models\Event;
use App\Models\Event\Evidence;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;

class Edit extends Component
{
    use WithFileUploads;

    public $event;
    public $evidence;
    public $file;
    public $status;

    public $listeners = [
        'saveStatus',
        'saveSended'
    ];

    public $rules = [
        'evidence.name' => ''
    ];

    public function mount(Event $event, Evidence $evidence)
    {
        $this->event = $event;
        $this->evidence = $evidence;
    }

    public function save()
    {
        $this->validate([
            'file' => 'required|file|max:40000'
        ]);
        if ($this->file) {
            $file = $this->file->store('evidence', ['disk' => 'public']);
            $this->evidence->path = $file;
            $this->evidence->uploaded_date = Carbon::now('Europe/London');
            $this->evidence->status = 'en revisión';
            $this->comments = null;
            $this->evidence->save();
        }
        $this->emit('alert', 'El documento fue subido exitosamente, el departamento jurídico lo analizará para validar que sea correcto.');
    }

    public function updateStatus($status)
    {
        if (request()->user()->hasPermission('Jurídico') || request()->user()->hasPermission('Administrator')) {
            $this->status = $status;
            $this->validate([
                'status' => 'required|in:validado,rechazada,en revisión'
            ]);
            if ($this->status == 'rechazada')
                $this->emit('alert_message', ['title' => 'Escribe el motivo de rechazo', 'word' => 'el motivo de rechazo', 'emitTo' => 'event.legitimation.evidence.edit', 'callback' => 'saveStatus', 'id' => $this->evidence->id]);
            else if ($this->status == 'validado') {
                $this->evidence->status = 'validada';
                $this->evidence->save();
                $this->emit('alert', 'La evidencia fue autorizada exitosamente');
            } else if ($this->status == 'en revisión') {
                $this->evidence->status = 'en revisión';
                $this->evidence->save();
                $this->emit('alert', 'La evidencia fue marcada como pendiente de revisión exitosamente');
            }
        }
    }

    public function saveStatus(Evidence $evidence, string $message)
    {
        $evidence->comments = $message;
        $evidence->status = 'rechazada';
        $evidence->save();
        $this->evidence = $evidence;
        $this->emit('alert', 'La evidencia fue rechazada exitosamente.');
    }

    public function setSended()
    {
        $this->emit(
            'alert_confirmation',
            [
                'title' => "¿Deseas marcar esta evidencia como enviada al CFCRL?",
                'word' => 'si',
                'emitTo' => 'event.legitimation.evidence.edit',
                'callback' => 'saveSended',
                'id' => $this->evidence->id
            ]
        );
    }

    public function saveSended(Evidence $evidence)
    {
        $evidence->sended = 'si';
        $evidence->save();
        $this->evidence = $evidence;
        $this->emit('alert', 'La evidencia fue marcada como enviada al CFCRL exitosamente.');
    }


    public function render()
    {
        return view('livewire.event.legitimation.evidence.edit');
    }
}
