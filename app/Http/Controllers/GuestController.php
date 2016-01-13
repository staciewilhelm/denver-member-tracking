<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;

use App\Services\GoogleCalendar;

use App\User;
use App\UserClockin;
use App\UserRequirement;

use DateTime;

class GuestController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Landing Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders the "marketing page" for the application and
	| is configured to only allow guests. Like most of the other sample
	| controllers, you are free to modify or remove it as you desire.
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest');
	}

	/**
	 * Returns an array of merged events from both the
	 * Practices & Bouts and Activities & Events calendars
	 *
	 * @param App\Services\GoogleCalendar   $calendar
	 * @return array
	 */
	public function index() {
		return view('landing');
	}

	/**
	 * Waiver Information
	 *
	 * @param Request			$request
	 * @return Response
	 */
	public function waiver(Request $request) {

		$method = $request->method();

		if ($request->isMethod('post')) {

			$input = $request->all();
			var_dump('the post!', $input);

			// once sync is complete, show a list of newly added members
			// note on the list page newly added members (use the star?)
		} else {
			//var_dump('the get!');
		}
		return view('waiver');
	}

	/**
	 * Returns an array of merged events from both the
	 * Practices & Bouts and Activities & Events calendars
	 *
	 * @param App\Services\GoogleCalendar   $calendar
	 * @return array
	 */
	public function clockin(Request $request, GoogleCalendar $calendar) {
		// thanks page
		if (stripos($request->path(), 'thanks')) {
			return view('clock-in-thanks');
		// clock in page
		} else {
			// save the clockin
			if ($request->isMethod('post')) {
				$input = $request->all();

				$userId = User::where('clock_number', $input['clock_number'])->pluck('id');
				$selectedEvent = explode(' :: ', $input['event_type']);
				$eventDetails = explode(' | ', $selectedEvent[1]);

				$calDate = $selectedEvent[0];
				$calTime = $eventDetails[0];
				$times = explode(' - ', $calTime);
				$startTime = $times[0];
				$endTime = $times[1];

				$eventDateStartTime = $calDate .' '.$startTime;

				$clockedTimeString = strtotime($input['clock_time']);
				$eventStartTimeString = strtotime($eventDateStartTime);

				$event = explode(': ', $eventDetails[1]);
				$type = $event[0];
				$calendarName = $event[1];

				$data = array(
					'user_id' => $userId,
					'clock_number' => $input['clock_number'],
					'type' => strtolower($type),
					'calendar_name' => $calendarName,
					'calendar_date' => $this->formatDateTime($eventDateStartTime),
					'calendar_time' => $this->formatDateTime($eventDateStartTime, 'time'),
					'clocked' => $this->formatDateTime($input['clock_time'], 'datetime')
				);

				// late clockins do not make a clockin invalid
				// mark late if user marked late OR if not marked late but same day and > 5 min or < 15 min late
				if (isset($input['late_reason'])) {
					$data['late_clockin'] = 1;
					$data['late_clockin_note'] = $input['late_reason'];
					if (isset($input['late_reason_other'])) $data['late_clockin_note'] .= ': '.$data['late_other_reason'];
				}

				$data['invalid'] = false;

				// user marked as late
				if (isset($input['late_reason']) && ($input['late_reason'] === 'Late')) {
					$data['invalid_desc'] = 'Clock-in marked as late by member.';
					$data['invalid'] = true;
				}

				// 15+ minutes past start time
				if (!isset($input['late_reason']) && (round(abs($clockedTimeString - $eventStartTimeString) / 60,2) > 15)) {
					$data['invalid_desc'] = 'Clock-in was 15+ minutes after practice with no late reason selected.';
					$data['invalid'] = true;
				}

				// clocking in for last hour; need full two hours to count as valid scrimmage
				if (($type === 'scrimmage') && ($startTime === '08:40PM')) {
					$data['invalid_desc'] = 'Clock-in was for last hour of scrimmage.';
					$data['invalid'] = true;
				}

				$duplicateClockins = UserClockin::where('user_id', '=', $data['user_id'])
					->where('clock_number', '=', $data['clock_number'])
					->where('type', '=', $data['type'])
					->where('calendar_name', '=', $data['calendar_name'])
					->where('calendar_date', '=', $data['calendar_date'])
					->where('invalid', '=', false)
					->get();

				// check if a duplicate clockin exists
				if (count($duplicateClockins) > 0) {
					$data['duplicate'] = true;

				// also need to update USER_REQUIREMENTS count
				} else {
					$req = UserRequirement::where('user_id', '=', $data['user_id'])
						->where('year', '=', date('Y'))
						->where('quarter', '=', $this->currentQtr())
						->first();

					switch ($data['type']) {
						case 'practice':
							$req->practice_count++;
							break;
						case 'scrimmage':
							$req->practice_count++;
							$req->scrimmage_count++;
							break;
						case 'activity':
							$req->activity_count++;
							break;
						case 'event':
							$req->event_count++;
							break;
						case 'bout':
							$req->bout_count++;
							break;
						case 'facility':
							$req->facility_count++;
							break;
					}

					$req->save();

				}

				$clockin = new UserClockin();
				$clockin->fill($data);
				$clockin->save();

				return redirect('clock-in/thanks');
			}

			return view('clock-in');

		} // end "thanks" check

	}

/**
 * Protected functions
 */

	// merge with member controller formatDateTime
	protected function formatDateTime($date, $dateType = 'date', $dataType = 'save') {
		if ($dataType === 'save') {
			$filteredDate = new DateTime($date);

			if ($dateType === 'date') return $filteredDate->format('Y-m-d');
			if ($dateType === 'time') return $filteredDate->format('H:i:s');
			if ($dateType === 'datetime') return $filteredDate->format('Y-m-d H:i:s');
		}

		if ($dataType === 'display') return date('U', strtotime($date)) * 1000;
	}

	// merge with member controller currentQtr
	protected function currentQtr() {
		$n = date('n');
		switch ($n) {
			case $n < 4:
				return 1;
				break;
			case ($n > 3 && $n < 7):
				return 2;
				break;
			case ($n > 6 && $n < 10):
				return 3;
				break;
			case ($n > 9):
				return 4;
				break;
		}
	}

}


