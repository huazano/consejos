<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Door;

class Coordination extends Model
{
    use HasFactory;

    public function doors()
    {
        return $this->hasMany(Door::class);
    }

    public function count_guests()
    {

        $doors = $this->doors;
        $count = 0;
        foreach ($doors as $door) {
            $count += $door->guests()->count();
        }
        return $count;
    }

    public function count_pending_guests()
    {

        $doors = $this->doors;
        $count = 0;
        foreach ($doors as $door) {
            $count += $door->guests()->whereNotNull('attendance_door_id')->count();
        }
        return $count;
    }
}
