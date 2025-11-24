<?php

namespace App\Http\Livewire\Event\Legitimation\Evidence;

use App\Models\Location;
use App\Models\Event;
use App\Models\Event\Evidence;
use App\Models\Event\Evidencetype;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithFileUploads;

class Upload extends Component
{
    use WithFileUploads;

    public $file;
    public $type = 'none';
    public $name;
    public $event;
    public $location;

    public function mount(Event $event, Location $location)
    {
        $this->event = $event;
        $this->location = $location;
    }


    public function save()
    {
        $this->validate([
            'name' => 'required|min:5|max:255',
            'type' => 'required|exists:evidencetypes,id',
            'file' => 'required|file|max:40000'
        ]);
        if ($this->file) {
            $file = $this->file->store('evidence', ['disk' => 'public']);
        }
        $evidence = Evidence::create([
            'event_id' => $this->event->id,
            'evidencetype_id' => $this->type,
            'location_id' => $this->location->id,
            'name' => $this->name,
            'limit_date' => Carbon::now(),
            'uploaded_date' => Carbon::now(),
            'path' => $file,
            'status' => 'en revisión'
        ]);

        redirect(route('legitimation.evidence.edit', ['event' => $this->event->id, 'evidence' => $evidence->id]));
    }

    public function render()
    {
        $types = Evidencetype::get();
        return view('livewire.event.legitimation.evidence.upload', compact('types'));
    }
}
