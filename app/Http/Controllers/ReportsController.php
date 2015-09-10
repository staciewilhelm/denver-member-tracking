<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\User;

use Illuminate\Http\Request;

class ReportsController extends Controller {

	// Gets all users in the users table and returns them
	public function listReports()
	{
		$users = User::all();

		return view('reports.list', compact('users'));
	}

}