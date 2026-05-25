<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    protected $fillable = [
        'event_id',
        'name',
        'reserved',
    ];

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function guest()
    {
        return $this->hasOne(Guest::class);
    }
}
