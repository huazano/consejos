<?php

namespace App\Http\Livewire\Event\Legitimation\Evidence\Types;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Event\Evidencetype;

class Create extends Component
{
    use WithFileUploads;

    public $file;
    public $name;
    public $description;

    public function save()
    {
        $this->validate([
            'file' => 'required|file|max:40000',
            'name' => 'required|min:3|max:255',
            'description' => 'required|min:10|max:1024',
        ]);
        if ($this->file) {
            $file = $this->file->store('evidencetypes', ['disk' => 'public']);
            Evidencetype::create([
                'name' => $this->name,
                'description' => $this->name,
                'path' => $file
            ]);
        }
        $this->emit('alert', 'El tipo de evidencia <b>' . $this->name . '</b> fue creado exitosamente.');
    }

    public function render()
    {
        return view('livewire.event.legitimation.evidence.types.create');
    }
}
