<?php

namespace App\Models;

use App\Models\Event\Archive;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Eventtype;
use App\Models\Location;

class Event extends Model
{
    use HasFactory;

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public function type()
    {
        return $this->belongsTo(Eventtype::Class);
    }

    public function locations()
    {
        return $this->hasMany(Location::class);
    }

    public function guests()
    {
        return $this->belongsToMany(User::class, 'guests', 'event_id')->withPivot(['location_id', 'door_id', 'attendance_location_id', 'attendance_door_id', 'manager_id']);
    }

    public function archives()
    {
        return $this->hasMany(Archive::class);
    }

    public function globalArchives()
    {
        return $this->archives()->whereNull('location_id')->orderBy('name')->get();
    }
}
