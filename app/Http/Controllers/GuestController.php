<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\GoogleCalendar;

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
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application welcome screen to the user.
	 *
	 * @return Response
	 */
	public function postClockin()
	{
		return view('clock-in');
	}


	/**
	 * Waiver Information
	 *
	 * @param Request                        $request
	 * @return Response
	 */
	public function waiver(Request $request)
		{

		$method = $request->method();

		if ($request->isMethod('post')) {
		    //
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
	public function index(GoogleCalendar $calendar)
	{
		$eventList = $mergedList = [];

		$events = $calendar->getMergedEvents();
		if (!empty($events)) {
			$formatted = $calendar->formatEventData($events);
			$startDates = $formatted['dates'];
			$events = $formatted['events'];

			$mergedList = $events;
			array_multisort($startDates, SORT_DESC, $mergedList);
			//dd($mergedList);
		}

		foreach ($mergedList as $key => $e) {
			$eventList[$e['group']][] = $e['display'];
		}

		return view('clock-in')->with(compact('eventList'));
	}

	// call with $this->testingStuff();
	protected function testingStuff($things) {
		return 'hello!';
	}

}


