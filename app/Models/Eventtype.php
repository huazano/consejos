<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event;

class Eventtype extends Model
{
    use HasFactory;

    public function events()
    {
        return $this->hasMany(Event::class);
    }
}
