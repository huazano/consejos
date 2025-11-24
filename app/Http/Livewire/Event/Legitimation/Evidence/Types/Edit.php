<?php

namespace App\Http\Livewire\Event\Legitimation\Evidence\Types;

use App\Models\Event\Evidencetype;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $evidence;
    public $file;

    protected $rules = [
        'evidence.name' => '',
        'evidence.description' => '',
        'evidence.path' => '',
    ];

    public function mount(Evidencetype $evidence)
    {
        $this->evidence = $evidence;
    }

    public function save()
    {
        $this->validate([
            'evidence.name' => 'required|min:5|max:255',
            'evidence.description' => 'required|min:10|max:1024',
            'file' => 'nullable'
        ]);
        if ($this->file) {
            $file = $this->file->store('evidencetypes', ['disk' => 'public']);
            $this->evidence->path = $file;
        }
        $this->evidence->save();
        $this->emit('alert', 'El tipo de evidencia fue actualizado exitosamente.');
    }

    public function render()
    {
        return view('livewire.event.legitimation.evidence.types.edit');
    }
}
