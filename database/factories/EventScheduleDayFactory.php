<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Event;
use App\Models\EventScheduleDay;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventScheduleDayFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = EventScheduleDay::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $events = Event::pluck('id')->toArray();

        return [
            'event_id' => $this->faker->randomElement($events),
            'date' => Carbon::today()->addDays(rand(1, 5)),
            'slot_every_in_mins' => $this->faker->numberBetween(1, 5)
        ];
    }
}
