<?php

namespace App\Repositories;

use App\Models\Event;
use App\Models\EventBooking;

/**
 * Repository class for model.
 */
class EventBookingRepository
{
    /**
     * DB operation to create a event booking.
     *
     * @param $data
     *
     * @return mixed
     */    
    public function createBooking($data)
    {
        $eventBooking = new EventBooking();
        $eventBooking->event_id = $data['event_id'];
        $eventBooking->user_first_name = $data['user_first_name'];
        $eventBooking->user_last_name = $data['user_last_name'];
        $eventBooking->user_email = $data['user_email'];        
        $eventBooking->event_schedule_day_id = $data['event_schedule_day_id'];
        $eventBooking->slot_start_time = $data['slot_start_time'];
        $eventBooking->slot_end_time = $data['slot_end_time'];
        $eventBooking->save();

        return $eventBooking;
    }

    /**
     * Get event booking by id.
     *
     * @param $eventId
     *
     * @return mixed
     */
    public function getEventBookingById($eventId)
    {
        return EventBooking::where('event_id', $eventId)->get();
    }
}