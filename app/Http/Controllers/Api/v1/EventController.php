<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Services\EventService;
use App\Http\Controllers\Controller;
use App\Http\Resources\Event\Event as EventResource;

class EventController extends Controller
{
    protected $eventService;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EventService $service)
    {
        $this->service = $service;
    }

    /**
     * Get all events.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllEvents(Request $request)
    {
        $allEvents = $this->service->getAllEvents();

        return EventResource::collection($allEvents);
    }
}
