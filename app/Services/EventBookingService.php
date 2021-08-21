<?php

namespace App\Services;

use Carbon\Carbon;
use App\Services\EventService;
use App\Models\EventScheduleAvailability;
use App\Repositories\EventBookingRepository;

/**
 * Event class to handle operator interactions.
 */
class EventBookingService
{
	/**
	 * The event service instance.
	 *
	 * @var eventService
	 */
	protected $eventService;

	/**
	 * The event booking repository instance.
	 *
	 * @var eventBookingRepository
	 */
	protected $eventBookingRepository;	

   	/**
     * Create a new service instance.
     *
     * @param EventService $eventService
     * @param EventBookingRepository $eventBookingRepository
     */
	public function __construct(EventService $eventService, EventBookingRepository $eventBookingRepository)
	{
		$this->eventService = $eventService;
		$this->eventBookingRepository = $eventBookingRepository;
	}

    /**
     * Handle logic to create an event booking.
     *
     * @param $data
     *
     * @return mixed
     */ 
	public function processEventBooking($data)
	{
		$now = Carbon::now()->startOfDay();
		$eventDetail = $this->eventService->getEventById($data['event_id']);
		$eventStartDateTime = Carbon::parse($eventDetail->start_date_time)->startOfDay();
		
		// restricting user to book when booking got exceeded
		$eventBookings = $this->eventBookingRepository->getEventBookingById($data['event_id']);
		if (count($eventBookings) >= $eventDetail->max_allowed_bookings) {
			return ['status' => 422, 'message' => 'Booking has been exceeded.'];
		}

		// restricting user to book if event has already started
		if ($now->gt($eventStartDateTime)) {
			return ['status' => 422, 'message' => 'Event has already started.'];
		}

		// restricting user to book when advance booking is opened
		$daysLeftForEvent = $now->diffInDays($eventStartDateTime);
		if ($daysLeftForEvent >= $eventDetail->advance_booking_min_days) {
			return ['status' => 422, 'message' => 'Pre booking is not opened yet.'];
		}

		// restricting user to book before event starts (as per value set in db)
		$minutesLeftForEvent = Carbon::now()->diffInMinutes(Carbon::parse($eventDetail->start_date_time));
		if ($minutesLeftForEvent <= $eventDetail->can_be_booked_before_event_starts_in_mins) {
			return ['status' => 422, 'message' => 'Booking has been closed.'];
		}

		// restricting user to book before if there is no available slots
		$isSlotDisabled = true;
		$requestSlotStartTime = Carbon::parse($data['slot_start_time']);
		$eventScheduleDayAvailability = EventScheduleAvailability::where('event_schedule_day_id', $data['event_schedule_day_id'])->select('start_time', 'end_time')->get();
		
		foreach ($eventScheduleDayAvailability as $key => $value) {
			$slotStartTime = Carbon::parse($value['start_time']);
			$slotEndTime = Carbon::parse($value['end_time']);
			if ($requestSlotStartTime->between($slotStartTime, $slotEndTime)) {
				$isSlotDisabled = false;
				break;
			}
		}

		if ($isSlotDisabled) {
			return ['status' => 422, 'message' => 'No available slots.'];
		}

		// creating event booking
		$this->eventBookingRepository->createBooking($data);
		
		return ['status' => 200, 'message' => 'Booking has been created successfully.'];
	}
}