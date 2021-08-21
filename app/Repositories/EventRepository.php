<?php

namespace App\Repositories;

use App\Models\Event;

/**
 * Repository class for model.
 */
class EventRepository
{
    public function getAllEvents()
    {
        return Event::all();
    }

    public function getEventById($id)
    {
        return Event::findOrFail($id);
    }    
}