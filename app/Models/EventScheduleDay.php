<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventScheduleDay extends Model
{
    use HasFactory;

    /**
     * The relationships that should always be loaded.
     *
     * @var array
     */
    protected $with = ['availability'];

    /**
     * Get the event schedule date availability detail.
     */
    public function availability()
    {
        return $this->hasMany(EventScheduleAvailability::class, 'event_schedule_day_id', 'id');
    }
}
