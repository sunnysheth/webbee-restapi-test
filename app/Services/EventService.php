<?php

namespace App\Services;

use App\Models\Event;
use App\Repositories\EventRepository;

/**
 * Event class to handle operator interactions.
 */
class EventService
{
	/**
	 * The event repository instance.
	 *
	 * @var repository
	 */
	protected $repository;

   	/**
     * Create a new service instance.
     *
     * @param EventRepository $repository
     */
	public function __construct(EventRepository $repository)
	{
		$this->repository = $repository;
	}

    /**
     * Get all events.
     *
     * @return mixed
     */
    public function getAllEvents()
    {
        return $this->repository->getAllEvents();
    }

    /**
     * Get event by id.
     *
     * @param $id
     *
     * @return mixed
     */
    public function getEventById($id)
    {
        return $this->repository->getEventById($id);
    }
}