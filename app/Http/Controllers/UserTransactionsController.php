<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Router;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;

use App\User;
use App\UserTransaction;

class UserTransactionsController extends Controller {

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

	// Gets all users in the users table and returns them
	public function index() {
		$transactions = UserTransaction::orderBy('trans_date', 'DESC')
												->get();

		foreach ($transactions as $key => $t) {
			$t->user_name = $t->user->first_name .' '.$t->user->last_name;
		}

		return view('transactions.list')->with(compact('transactions'));
	}

	// Grab all the data passed into the request and save a new record
	public function store(Request $request) {
		$trans = new UserTransaction();
		$trans->fill($request->all());

		$trans->due = date('Y-m-d', strtotime($trans->due));
		if ($trans->trans_final) $trans->trans_date = date('Y-m-d', strtotime($trans->trans_date));

		$trans->save();
	}

	// Grab all the data passed into the request and fill the database record with the new data
	public function update($id, Request $request) {
		$trans = UserTransaction::find($id);
		$trans->fill($request->all());

		$trans->due = date('Y-m-d', strtotime($trans->due));
		if ($trans->trans_final) $trans->trans_date = date('Y-m-d', strtotime($trans->trans_date));

		$trans->save();
	}

	// Find the time entry to be deleted and then call delete
	public function destroy($id) {
		UserTransaction::destroy($id);
	}

}