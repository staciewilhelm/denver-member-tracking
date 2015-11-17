<?php
//
//namespace App\Http\Controllers\Members;
//
//use App\Http\Controllers\Controller;
//use App\Services\GoogleCalendar;
//use App\Services\Venmo;
//
//class VenmoController extends Controller {
//
//	/*
//	|--------------------------------------------------------------------------
//	| Welcome Controller
//	|--------------------------------------------------------------------------
//	|
//	| This controller renders the "marketing page" for the application and
//	| is configured to only allow guests. Like most of the other sample
//	| controllers, you are free to modify or remove it as you desire.
//	|
//	*/
//
//	/**
//	 * Create a new controller instance.
//	 *
//	 * @return void
//	 */
//	public function __construct()
//	{
//		$this->middleware('auth');
//	}
//
//	/**
//	 * Show the application welcome screen to the user.
//	 *
//	 * @return Response
//	 */
//	public function index()
//	{
//		return view('welcome');
//	}
//
//
//
//
//
//	public function authorized(Venmo $venmo) {
//		var_dump('');
//
//
//		$venmo
//		return view('calendar')->with(compact('result'));
//	}
//
//
//
//
//	public function calendar(GoogleCalendar $calendar)
//	{
//
//    $calendarId = 'denverrollerdolls.org_cc37m0abv3pplm5qiocsi09ock@group.calendar.google.com';
//    $result = $calendar->get($calendarId);
//
//		return view('calendar')->with(compact('result'));
//	}
//
//	public function loginWithGoogle(Request $request)
//{
//    // get data from request
//    $code = $request->get('code');
//
//    // get google service
//    $googleService = \OAuth::consumer('Google');
//
//    // check if code is valid
//
//    // if code is provided get user data and sign in
//    if ( ! is_null($code))
//    {
//        // This was a callback request from google, get the token
//        $token = $googleService->requestAccessToken($code);
//
//        // Send a request with it
//        $result = json_decode($googleService->request('https://www.googleapis.com/oauth2/v1/userinfo'), true);
//
//        $message = 'Your unique Google user id is: ' . $result['id'] . ' and your name is ' . $result['name'];
//        echo $message. "<br/>";
//
//        //Var_dump
//        //display whole array.
//        dd($result);
//    }
//    // if not ask for permission first
//    else
//    {
//        // get googleService authorization
//        $url = $googleService->getAuthorizationUri();
//
//        // return to google login url
//        return redirect((string)$url);
//    }
//}
//
//
//}
//