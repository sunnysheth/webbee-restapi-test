<?php

namespace Database\Seeders;

use App\Models\Event;
use App\Models\EventScheduleDay;
use App\Models\EventScheduleAvailability;
use Illuminate\Database\Seeder;

class EventSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        \DB::table('events')->truncate();
        \DB::table('event_schedule_days')->truncate();
        \DB::table('event_schedule_availability_details')->truncate();
        
        Event::factory(5)->create();
        EventScheduleDay::factory(5)->create();
        EventScheduleAvailability::factory(5)->create();
    }
}
