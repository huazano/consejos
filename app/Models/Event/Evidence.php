<?php

namespace App\Models\Event;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Event\Evidencetype;
use Illuminate\Support\Facades\Storage;

class Evidence extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'evidences';
    protected $casts = [
        'limit_date' => 'datetime',
        'uploaded_date' => 'datetime'
    ];

    public function evidencetype()
    {
        return $this->belongsTo(Evidencetype::class);
    }

    public function getExampleUrl()
    {
        return Storage::url($this->evidencetype->path);
    }
}
