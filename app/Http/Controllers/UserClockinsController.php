<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\GoogleCalendar;
use App\UserClockin;

use Illuminate\Support\Facades\Request;

class UserClockinsController extends Controller {

	// Gets time entries and eager loads their associated users
	public function index() {
		$clockins = UserClockin::with('user')->get();

		return $clockins;
	}

	// Grab all the data passed into the request and save a new record
	public function store() {
		$data = Request::all();

		$clockin = new UserClockin();

		$clockin->fill($data);

		$clockin->save();

	}

	// Grab all the data passed into the request and fill the database record with the new data
	public function update($id) {
		$clockin = UserClockin::find($id);

		$data = Request::all();

		$clockin->fill($data);

		$clockin->save();
	}

	// Find the time entry to be deleted and then call delete
	public function destroy($id) {
		$clockin = UserClockin::find($id);

		$clockin->delete();   
	}

}