<?php

namespace App\Http\Resources\EventScheduleDayAvailability;

use Carbon\Carbon;
use Carbon\CarbonPeriod;
use App\Models\EventBooking;
use Illuminate\Http\Resources\Json\JsonResource;

class EventScheduleDayAvailability extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $duration = $this->eventScheduleDay->slot_every_in_mins;
        $slots = $this->getTimeSlots($this->start_time, $this->end_time, $duration);
        $bookedSlots = EventBooking::where('event_schedule_day_id', $this->event_schedule_day_id)
                                    ->select(['slot_start_time', 'slot_end_time', 'id'])
                                    ->get()
                                    ->toArray();

        return [
            'event_schedule_day_id' => $this->event_schedule_day_id,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'slots' => $slots,
            'booked_slots' => $bookedSlots
        ];
    }

    /**
     * Get time slots for an event.
     *
     * @param  $startTime
     * @param  $endTime
     * @param  $duration
     * @return array
     */
    public function getTimeSlots($startTime, $endTime, $duration)
    {
        $i=0;
        $slots = [];
        $startTime = Carbon::parse($startTime)->format('H:i');
        $endTime = Carbon::parse($endTime)->format('H:i');
        
        while(strtotime($startTime) <= strtotime($endTime)) {
            $start = $startTime;
            $end = date('H:i', strtotime('+'.$duration.' minutes', strtotime($startTime)));
            $startTime = date('H:i', strtotime('+'.$duration.' minutes', strtotime($startTime)));
            $i++;
            if(strtotime($startTime) <= strtotime($endTime)) {
                $slots[$i]['start'] = $start;
                $slots[$i]['end'] = $end;
            }
        }

        return $slots;
    }
}
