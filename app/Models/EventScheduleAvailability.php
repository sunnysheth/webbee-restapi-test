<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventScheduleAvailability extends Model
{
    use HasFactory;

    protected $table = 'event_schedule_availability_details';

    /**
     * Get the event schedule date availability detail.
     */
    public function eventScheduleDay()
    {
        return $this->belongsTo(EventScheduleDay::class);
    }    
}
