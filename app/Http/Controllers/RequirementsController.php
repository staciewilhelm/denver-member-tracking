<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Router;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

use App\Requirement;
use App\Team;
use App\User;

class RequirementsController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		
	}

	// Gets all users in the users table and returns them
	public function index() {
		$reqs = Requirement::orderBy('year', 'DESC')
												->orderBy('quarter', 'DESC')
												->orderBy('team_id', 'DESC')
												->get();

		$teams = Team::where('active', true)->get();

		foreach ($reqs as $key => $req) {
			$req->req_for = $req->type->name;
			if ($req->team_id !== null) $req->req_for .= ': '.$req->team->name;
		}

		return view('requirements.list')->with(compact('reqs', 'teams'));
	}

	// Grab all the data passed into the request and save a new record
	public function store(Request $request) {
		$req = new Requirement();
		$req->fill($request->all());
		$req->save();
	}

	// Grab all the data passed into the request and fill the database record with the new data
	public function update($id, Request $request) {
		$req = Requirement::find($id);
		$req->fill($request->all());
		$req->save();
	}

	// Find the time entry to be deleted and then call delete
	public function destroy($id) {
		Requirement::destroy($id);
	}

}