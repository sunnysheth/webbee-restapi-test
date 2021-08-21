<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Event;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class EventFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Event::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $eventName = $this->faker->word();
        $eventSlug = Str::slug($eventName, '-');
        
        return [
            'name' => $eventName,
            'slug' => $eventSlug,
            'can_be_booked_before_event_starts_in_mins' => $this->faker->numberBetween(1, 300),
            'advance_booking_min_days' => $this->faker->numberBetween(1, 5),
            'max_allowed_bookings' => $this->faker->numberBetween(1, 5),
            'start_date_time' => Carbon::now()->addDays(1),
            'end_date_time' => Carbon::now()->addDays(6),
        ];
    }
}