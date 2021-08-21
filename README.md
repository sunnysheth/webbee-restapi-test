# Laravel coding project
To create a feature complete REST API for time scheduling.

**Technical specifications:**
- MySQL or Postgres as database backend
- Laravel 8 as Framework 
- imagine the API is being consumed by a SPA (for example written with react or vue)

**Requirements**
All API features can be deduced from the following video which shows a similiar api in action.

- A time scheduling JSON based Rest API should be created
- provide the SPA with the following data through A SINGLE api endpoint:
	- data of all scheduled events so it can render the calendar and time slot selection 
	- scheduled events can last for x minutes, can be booked for x days in the future and a minimum of x minutes need to be left before the event starts
	- scheduled events have available and unavailable times based on weekdays (for example monday-friday 8:00-20:00 excluding 12:00-13:00 for a lunchbreak)
  - maximum amount of people that can book the event (for example 2)
  - available quantity left
- persist event bookings
- many participants can book at the same time
- For the tests purpose, A booking is done with only an E-Mail, first name and last name 
- validate the data so that the API returns an exception in case something does not fit into the schema or is already booked out

**Cases**  
- slots for the next 7 days, every 2 minutes, from 08:00-20:00, 13:00-14:00 lunch break, from monday to friday (check if the api provides all necessary data to display the slots in the frontend)
- book in a participant (available participant count should be reduced, participant should be saved)
- book in a participant for invalid times: booked out slot, out of range, disabled time (validation should fail)

**Steps to follow**
- composer install
- setup .env
- create a database
- php artisan migrate --seed