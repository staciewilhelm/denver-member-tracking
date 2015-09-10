<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Http\Request;

class UsersController extends Controller {

	// Gets all users in the users table and returns them
	public function index()
	{
		$users = User::all();

		return $users;
	}

}