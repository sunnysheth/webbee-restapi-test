<?php

namespace App\Http\Resources\Event;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\EventScheduleDay\EventScheduleDay as EventScheduleDayResource;

class Event extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $bookingCount = count($this->bookings);
        $availableBookings = $this->max_allowed_bookings - $bookingCount;

        return [
            'id'                                         => $this->id,
            'name'                                       => $this->name,
            'slug'                                       => $this->slug,
            'booking_closed_before_in_mins'              => $this->can_be_booked_before_event_starts_in_mins,
            'advance_booking_min_days'                   => $this->advance_booking_min_days,
            'max_amount_people'                          => $this->max_allowed_bookings,
            'start_date_time'                            => $this->start_date_time,
            'end_date_time'                              => $this->end_date_time,
            'available_quantity_left'                    => $availableBookings > 0 ? $availableBookings : 0,
            'event_schedule_days'                        => EventScheduleDayResource::collection($this->scheduledDays),
        ];
    }
}
