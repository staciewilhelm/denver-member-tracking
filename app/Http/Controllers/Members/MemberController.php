<?php

namespace App\Http\Controllers\Members;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\GoogleCalendar;
use App\Services\GoogleDirectory;

use App\User;

class MemberController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Member Controller
	|--------------------------------------------------------------------------
	|
	| This controller does a lot of stuff
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		$this->middleware('auth');
	}

	/**
	 * Returns an array of merged events from both the
	 * Practices & Bouts and Activities & Events calendars
	 *
	 * @param App\Services\GoogleCalendar   $calendar
	 * @param App\Services\GoogleDirectory  $directory
	 * @return array
	 */
	public function dashboard(GoogleCalendar $calendar, GoogleDirectory $directory)
	{

		/*if(\Auth::check()) {
			$stuff = \Auth::user()->have_role->name;
            // Do something
			var_dump($stuff);
        }*/

		$user = User::where('id', \Auth::user()->id)->first();

		return view('dashboard')->with(compact('user'));

	}

	/**
	 * Return logged practices for logged in member
	 *
	 * @return array
	 */
	public function loggedPractices()
	{


		var_dump(\Auth::user()->id);
		$user = User::where('id', \Auth::user()->id)->first();
		//var_dump($user);

		return view('logged.practices');
	}

	/**
	 * Return logged activities for logged in member
	 *
	 * @return array
	 */
	public function loggedActivities()
	{

		return view('logged.activities');
	}

	/**
	 * Return logged Venmo payments for logged in member
	 *
	 * @return array
	 */
	public function loggedPayments()
	{

		return view('logged.payments');
	}






	/**
	 * Returns data for one user by id
	 *
	 * @param number  $account_id
	 * @return array
	 */
	public function view($account_id)
	{
		return view('members.view');
	}

	/**
	 * Update a user by id
	 *
	 * @param number  $account_id
	 * @return array
	 */
	public function edit($account_id)
	{
		return view('members.edit');
	}

	/**
	 * Return data for all members within the system
	 *
	 * @return array
	 */
	public function getMembers()
	{
		//var_dump('hollllaa');
		return view('members.list');
	}

/*
	Route::group(['prefix' => 'members/{account_id}'], function () {
			// Matches the members/{account_id}/detail URL
			Route::get('detail', 'Members\MemberController@view');

			// Matches the members/{account_id}/payments URL
			Route::get('payments', 'Members\VenmoController@payments');

			// Matches the members/{account_id}/update URL
			Route::put('update', 'Members\MemberController@edit');

		});
		// end members/{account_id} routing

		// routes for member listing
		Route::group(['prefix' => 'members'], function () {
			// Matches the members URL
			Route::get('/', 'Members\MemberController@list');

			// Matches the members/sync URL
			Route::get('sync', 'Members\GoogleController@sync');

			// Matches the members/reports URL
			Route::get('reports', 'Members\MemberController@reports');*/

}
