<?php

namespace App\Http\Livewire\Profile;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ChangePassword extends Component
{
    public string $oldPassword = '';
    public string $newPassword = '';
    public string $newConfirmPassword = '';

    protected $rules = [
        'oldPassword' => 'required',
        'newPassword' => 'required|min:6|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/|max:255',
        'newConfirmPassword' => 'required|same:newPassword'
    ];

    public function changePassword()
    {
        $user = User::find(auth()->user()->id);
        $this->validate();
        if ($user->currentPasswordIsValid($this->oldPassword)) {
            $user->updatePassword($this->oldPassword, $this->newPassword);
            return redirect(route('legitimation.index'));
        } else {
            $this->emit('alert', ['La contraseña actual es incorrecta.', 'error']);
        }
    }

    public function render()
    {
        return view('livewire.profile.change-password');
    }
}
