<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AttendanceHistory extends Model
{
    use HasFactory;

    protected $table = 'attendance_history';

    protected $fillable = [
        'event_id',
        'user_id',
        'location_id',
        'door_id',
        'type',
        'registered_at'
    ];

    protected $casts = [
        'registered_at' => 'datetime'
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function location()
    {
        return $this->belongsTo(Location::class);
    }

    public function door()
    {
        return $this->belongsTo(Door::class);
    }
}
