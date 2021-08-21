<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\EventScheduleDay;
use App\Models\EventScheduleAvailability;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventScheduleAvailabilityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventScheduleAvailability::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $eventScheduleDay = EventScheduleDay::pluck('id')->toArray();
        
        return [
            'event_schedule_day_id' => $this->faker->unique()->randomElement($eventScheduleDay),
            'start_time' => Carbon::now()->startOfDay()->addHours(1),
            'end_time' => Carbon::now()->startOfDay()->addHours(2)
        ];
    }
}
