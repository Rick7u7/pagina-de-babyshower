<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = [
        'name',
        'date',
        'location',
        'description',
        'user_id',
    ];

    public function guests()
    {
        return $this->hasMany(Guest::class);
    }

    public function gifts()
    {
        return $this->hasMany(Gift::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
