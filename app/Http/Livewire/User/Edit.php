<?php

namespace App\Http\Livewire\User;

use App\Models\Permission;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $user;
    public $permissions;
    public $profile_photo;
    protected $listeners = ['set_new_password'];
    protected $rules = [
        'user.username' => 'required|min:3|max:30',
        'user.name'     => 'required|min:3|max:255',
        'user.email'    => 'required|min:5|max:255',
        'profile_photo' => 'nullable|image|max:1024',
        'user.permission_id'    => 'required',
    ];

    public function mount(User $user)
    {
        $this->permissions = Permission::get();
        $this->user = $user;
    }

    public function save()
    {
        $this->validate([
            'user.username' => 'required|unique:users,users.username,' . $this->user->id . '|min:3|max:30',
            'user.name'     => 'required|min:3|max:255',
            'user.email'    => 'required|email|unique:users,users.email,' . $this->user->id . '|min:5|max:255',
            'profile_photo' => 'nullable|image|max:1024',
            'user.permission_id'    => 'required|exists:permissions,permissions.id',
        ]);
        if ($this->profile_photo) {
            $profile_photo_path = $this->profile_photo->store('profile_photos', ['disk' => 'public']);
            $this->user->profile_photo_path = $profile_photo_path;
        }
        $this->user->save();
        $this->emit('alert', 'Exito');
    }

    public function reset_password()
    {
        $this->emit('alert_confirmation', ['title' => __('Are you sure you want to <b>change the password</b>?'), 'word' => __('YES'), 'emitTo' => 'user.edit', 'callback' => 'set_new_password', 'id' => $this->user->id]);
    }

    public function set_new_password(User $user)
    {
        $rawPassword = Str::random(8);
        $encodedPassword = Hash::make($rawPassword);
        $this->user->password = $encodedPassword;
        $this->user->change_password = 1;
        $this->user->save();
        $this->emit('alert', __('Password was successfully changed, your new password is') . ' <b class="text-red-600">' . $rawPassword . '</b>');
    }

    public function render()
    {
        return view('livewire.user.edit');
    }
}
