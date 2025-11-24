<?php

namespace App\Http\Livewire\Event\Legitimation;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use App\Models\Event;
use Livewire\WithPagination;

class Guests extends Component
{
    use WithFileUploads;
    use WithPagination;
    public $search;
    public $event;
    public $users;
    public $view = 'show';
    public $users_data = [];

    protected $rules = [
        'users' => ''
    ];

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function mount(Event $event)
    {
        $this->event = $event;
    }

    public function update()
    {
        $this->validate();
        $path = $this->users->getRealPath();
        $data = array_map('str_getcsv', file($path));

        foreach ($data as $i => $user) {
            if ($i > 0) {
                if (isset($user[2]) && isset($user[3])) {
                    $db_user = User::where('username', $user[0])->first();
                    $exists_sede = $this->event->locations()->where('name', $user[2])->exists();
                    if (!$exists_sede) {
                        $exists_door = false;
                    } else {
                        $exists_door = $this->event->locations()->where('name', $user[2])->first()->doors()->where('name', $user[3])->exists();
                    }
                    if ($db_user) {
                        array_push($this->users_data, ['db' => $db_user, 'username' => $user[0], 'name' => $user[1], 'new' => false, 'sede' => $user[2], 'new_sede' => $exists_sede, 'door' => $user[3], 'new_door' => $exists_door]);
                    } else {
                        $db_user = new User();
                        array_push($this->users_data, ['db' => $db_user, 'username' => $user[0], 'name' => $user[1], 'new' => true, 'sede' => $user[2], 'new_sede' => $exists_sede, 'door' => $user[3], 'new_door' => $exists_door]);
                    }
                }
            }
        }
        foreach ($this->users_data as $user) {
            if (!$user['new_sede'] && !$this->event->locations()->where('name', $user['sede'])->exists()) {
                $this->event->locations()->create([
                    'name' => $user['sede']
                ]);
            }
            $sede = $this->event->locations()->where('name', $user['sede'])->first();
            if (!$user['new_door'] && !$sede->doors()->where('name', $user['door'])->exists()) {
                $sede->doors()->create([
                    'name' => $user['door']
                ]);
            }
            $door = $sede->doors()->where('name', $user['door'])->first();
            if (!isset($user['db']['id'])) {
                $new_user = new User();
                $new_user->username = $user['username'];
                $new_user->name = $user['name'];
                $new_user->email = $user['username'] . '@suterm.digital';
                $new_user->password = Hash::make(Str::random(40));
                $new_user->save();
            } else {
                $new_user = User::find($user['db']['id']);
                $new_user->name = $user['name'];
                $new_user->save();
            }
            if ($this->event->guests()->where('user_id', $new_user->id)->exists()) {
                $current_user = $this->event->guests()->where('user_id', $new_user->id)->first();
                $current_user->pivot->location_id = $sede->id;
                $current_user->pivot->door_id = $door->id;
                $current_user->pivot->save();
            } else {
                $this->event->guests()->attach($new_user->id, array('location_id' => $sede->id, 'door_id' => $door->id));
            }
        }
        $this->view = 'update';
    }

    public function save()
    {
        return redirect(route('legitimation.guests', ['event' => $this->event]));
    }

    public function render()
    {
        $user_list = $this->event->guests()->paginate(20);
        return view('livewire.event.legitimation.guests', compact('user_list'));
    }
}
