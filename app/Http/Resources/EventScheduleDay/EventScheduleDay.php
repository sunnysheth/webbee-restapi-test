<?php

namespace App\Http\Resources\EventScheduleDay;

use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\EventScheduleDayAvailability\EventScheduleDayAvailability as EventScheduleDayAvailabilityResource;

class EventScheduleDay extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'event_id' => $this->event_id,
            'date' => $this->date,
            'slot_every_in_mins' => $this->slot_every_in_mins,
            'availability' => EventScheduleDayAvailabilityResource::collection($this->availability),
        ];
    }
}
