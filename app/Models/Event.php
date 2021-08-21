<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\EventScheduleDay;

class Event extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['scheduledDays', 'bookings'];

    /**
     * Get all event scheduled days.
     */
    public function scheduledDays()
    {
        return $this->hasMany(EventScheduleDay::class, 'event_id', 'id');
    }

    /**
     * Get all event scheduled days.
     */
    public function bookings()
    {
        return $this->hasMany(EventBooking::class, 'event_id', 'id');
    }    
}
