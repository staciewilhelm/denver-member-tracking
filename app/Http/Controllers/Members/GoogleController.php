<?php 

namespace App\Http\Controllers\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GoogleCalendar;
use App\Services\GoogleDirectory;
use App\Services\MemberDataParser;

use App\User;

class GoogleController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Welcome Controller
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

	}

	/**
	 * Syncs the local database with the current Google Directory
	 * of all Denver skaters
	 *
	 * @param App\Services\GoogleCalendar   $calendar
	 * @return Response array
	 */
	public function upcomingEvents(GoogleCalendar $calendar) {
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
			$eventList[$e['group']][] = array('display'=>$e['display'], 'date'=>$e['group']);
		}
		return $eventList;
	}


	/**
	 * Syncs the local database with the current Google Directory
	 * of all Denver skaters
	 *
	 * @param Request                        $request
	 * @param App\Services\GoogleDirectory   $parser
	 * @param App\Services\MemberDataParser  $directory
	 * @return Response
	 */
	public function sync(Request $request, GoogleDirectory $directory, MemberDataParser $parser) {
		$this->middleware('auth');
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

		return view('members.sync');
	}



/*	public function calendar(GoogleCalendar $calendar)
	{

    $calendarId = 'denverrollerdolls.org_cc37m0abv3pplm5qiocsi09ock@group.calendar.google.com';
    $result = $calendar->get($calendarId);

		return view('calendar')->with(compact('result'));
	}

	public function loginWithGoogle(Request $request)
{
    // get data from request
    $code = $request->get('code');

    // get google service
    $googleService = \OAuth::consumer('Google');

    // check if code is valid

    // if code is provided get user data and sign in
    if ( ! is_null($code))
    {
        // This was a callback request from google, get the token
        $token = $googleService->requestAccessToken($code);

        // Send a request with it
        $result = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);

        $message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
        echo $message. "<br/>";

        //Var_dump
        //display whole array.
        dd($result);
    }
    // if not ask for permission first
    else
    {
        // get googleService authorization
        $url = $googleService->getAuthorizationUri();

        // return to google login url
        return redirect((string)$url);
    }
}*/


}
