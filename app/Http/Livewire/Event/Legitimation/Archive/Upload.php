<?php

namespace App\Http\Livewire\Event\Legitimation\Archive;

use App\Models\Event;
use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Location;

class Upload extends Component
{
    use WithFileUploads;

    public $file;
    public $event;
    public $location;
    public $name;

    public function mount(Event $event, $location)
    {
        $this->event = $event;
        $this->location = Location::find($location);
    }

    public function save()
    {
        $this->validate([
            'file' => 'required|file|max:40000',
            'name' => 'required|min:3|max:255',
        ]);
        if ($this->file) {
            $file = $this->file->store('archive', ['disk' => 'public']);
            $this->event->archives()->create([
                'location_id' => $this->location->id ?? null,
                'name' => $this->name,
                'path' => $file
            ]);
        }
        $this->emit('alert', 'El document <b>' . $this->name . '</b> fue subido exitosamente en el expediente ' . ($this->location->name ?? 'global'));
    }

    public function render()
    {
        return view('livewire.event.legitimation.archive.upload');
    }
}
