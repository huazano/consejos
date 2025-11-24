<?php

namespace App\Http\Livewire\Event\Legitimation\Location;

use App\Models\Event;
use App\Models\Location as ModelsLocation;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;
use Livewire\WithFileUploads;

class Location extends Component
{
    use WithFileUploads;

    public $convocatoria;
    public $event;
    public $location;
    public $user;

    protected $rules = [
        'location.boletas' => 'required|numeric',
        'location.description' => '',
        'location.georeferences' => '',
        'location.schedule' => ''
    ];

    public function mount(Event $event, ModelsLocation $location)
    {
        $this->event = $event;
        $this->location = $location;
    }

    public function save()
    {
        if ($this->convocatoria) {
            $convocatoria_path = $this->convocatoria->store('convocatorias', ['disk' => 'public']);
            $this->location->convocatoria = $convocatoria_path;
        }
        $this->location->save();
        $this->emit('alert', 'La sede fue actualizada exitosamente.');
    }

    public function add_user(User $user)
    {
        $this->location->users()->attach($user->id);
    }

    public function remove_user(User $user)
    {
        $this->location->users()->detach($user->id);
    }

    public function render()
    {
        $search = User::whereDoesntHave('locations', function (Builder $query) {
            $query->where('location_id', $this->location->id);
        })->where('username', 'like', "%$this->user%")->paginate(10);
        $users = $this->location->fresh()->users;
        return view('livewire.event.legitimation.location.location', compact('search', 'users'));
    }
}
