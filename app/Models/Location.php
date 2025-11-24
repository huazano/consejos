<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Door;
use App\Models\Event;
use App\Models\User;
use App\Models\Event\Archive;
use App\Models\Event\Evidence;

class Location extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function doors()
    {
        return $this->hasMany(Door::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function archives()
    {
        return $this->hasMany(Archive::class);
    }

    public function evidences()
    {
        return $this->hasMany(Evidence::class);
    }

    public function guests()
    {
        return $this->belongsToMany(User::class, 'guests', 'location_id')->withPivot(['event_id', 'door_id', 'attendance_location_id', 'attendance_door_id', 'manager_id']);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
