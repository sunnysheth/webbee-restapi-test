<?php

namespace App\Http\Resources\EventScheduleDayAvailability;

use Illuminate\Http\Resources\Json\ResourceCollection;

class EventScheduleDayAvailabilityCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return parent::toArray($request);
    }
}
