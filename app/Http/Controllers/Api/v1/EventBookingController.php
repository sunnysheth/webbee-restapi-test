<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\EventBookingService;
use Illuminate\Support\Facades\Validator;

class EventBookingController extends Controller
{
    protected $service;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(EventBookingService $service)
    {
        $this->service = $service;
    }

    /**
     * Make booking.
     *
     * @return \Illuminate\Http\Response
     */
    public function makeBooking(Request $request)
    {
        // check if data is validated
        $validator = $this->isValidated($request->all());
        if ($validator->fails()) {
            return response(['errors' => $validator->errors()], 401);
        }

        // processing event booking related information and creating records
        $data = $this->service->processEventBooking($request->all());

        return response()->json([
            'message' => $data['message']
        ], $data['status']);
    }

    public function isValidated($data)
    {
        $messages = [
            'event_id.required' => 'The event field is required.',
            'user_first_name.required' => 'The first name is required.',
            'user_last_name.required' => 'The last name is required.',
            'user_email.required' => 'The email address is required.',
            'slot_start_time.required' => 'The slot start time is required.',
            'slot_end_time.required' => 'The slot end time is required.',
        ];

        return Validator::make($data, [
            'event_id'           => 'required',
            'user_first_name'    => 'required',
            'user_last_name'     => 'required',
            'user_email'         => 'required',
            'slot_start_time'    => 'required',
            'slot_end_time'      => 'required'
        ], $messages);
    }
}
