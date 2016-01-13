<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Router;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

use App\User;

class UsersController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	public function autocompleteUsers() {
		$users = User::whereRaw('mem_status IN ("Active", "Pending") AND venmo_handle IS NOT NULL')
									->select('id', 'first_name', 'last_name', 'skater_name', 'venmo_handle')
									->get();

		return $users;
	}

	// Gets all users in the users table, requirements and clockins
	public function getUsersRequirements($userId) {
		if (empty($userId)) return null;

		$user = User::find($userId);
		return array('user'=>$user, 'clockins'=>$user->clockins, 'requirements'=>$user->requirements);
	}

	public function clockNumbers() {
		$clockNumbers = User::lists('clock_number');
		return $clockNumbers;
	}

}