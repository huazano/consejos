<?php

namespace App\Models;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Role;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

    public function permission()
    {
        return $this->belongsTo(Permission::class);
    }

    public function hasAnyRole(array $roles): bool
    {
        foreach ($roles as $role) {
            if ($this->hasRole($role)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole(string $role): bool
    {
        return $this->roles()->where('name', $role)->first() ? true : false;
    }

    public function hasPermission(string $permission): bool
    {
        if (!$this->permission)
            return false;
        return $this->permission->name == $permission ? true : false;
    }

    public function currentPasswordIsValid($currentPassword)
    {
        return Hash::check($currentPassword, $this->password);
    }

    public function updatePassword($currentPassword, $newPassword)
    {
        if ($this->currentPasswordIsValid($currentPassword)) {
            $this->password = Hash::make($newPassword);
            $this->change_password = null;
            $this->save();
        }
    }

    public function events()
    {
        return $this->belongsToMany(Event::class, 'guests', 'user_id')->withPivot(['location_id', 'door_id', 'attendance_location_id', 'attendance_door_id', 'manager_id', 'is_member']);
    }

    public function location()
    {
        return Location::find($this->pivot->location_id);
    }

    public function locations()
    {
        return $this->belongsToMany(Location::class);
    }

    public function door()
    {
        return Door::find($this->pivot->door_id);
    }
}
