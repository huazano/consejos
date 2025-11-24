<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Location;
use App\Models\Coordination;

class Door extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function attendances()
    {
        return $this->belongsToMany(User::class, 'guests', 'attendance_door_id', 'user_id')->withPivot('attendance_date')->orderBy('pivot_attendance_date', 'desc');
    }

    public function guests()
    {
        return $this->belongsToMany(User::class, 'guests', 'door_id', 'user_id')->withPivot('attendance_door_id');
    }

    public function coordination()
    {
        return $this->belongsTo(Coordination::class);
    }
}
