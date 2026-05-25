<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guest extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'email',
        'status',
        'gift_id',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function gift()
    {
        return $this->belongsTo(Gift::class);
    }
}
