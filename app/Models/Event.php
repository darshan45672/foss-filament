<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /** @use HasFactory<\Database\Factories\EventFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'location',
        'event_date',
        'description',
    ];

    public function registrations()
    {
        return $this->hasMany(EventRegisteration::class);
    }
}
