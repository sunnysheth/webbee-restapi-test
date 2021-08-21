<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\EventBooking;
use App\Models\EventScheduleDay;
use Illuminate\Database\Seeder;

class EventBookingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('event_bookings')->truncate();

        $faker = \Faker\Factory::create();
        $eventScheduleDays = EventScheduleDay::all();
        foreach ($eventScheduleDays as $key => $value) {

            if (!$value->availability()->exists()) {
                continue;
            }
            $availableStartTime = $value->availability()->first()->start_time;
            $eventBooking = new EventBooking();
            $eventBooking->event_id = $value->event_id;
            $eventBooking->user_first_name = $faker->firstNameMale;
            $eventBooking->user_last_name = $faker->firstNameMale;
            $eventBooking->user_email = $faker->unique()->safeEmail();
            $eventBooking->event_schedule_day_id = $value->id;
            $eventBooking->slot_start_time = $availableStartTime;
            $eventBooking->slot_end_time = Carbon::parse($availableStartTime)->addMinutes($value->slot_every_in_mins)->format('H:i:s');
            $eventBooking->save();
        }
    }
}
