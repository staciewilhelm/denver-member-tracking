<?php
namespace App\Http\Controllers\Auth;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;

class AuthController extends Controller {
	/*
	|--------------------------------------------------------------------------
	| Registration & Login Controller
	|--------------------------------------------------------------------------
	|
	| This controller handles the registration of new users, as well as the
	| authentication of existing users. By default, this controller uses
	| a simple trait to add these behaviors. Why don't you explore it?
	|
	*/
	use AuthenticatesAndRegistersUsers, ThrottlesLogins;
	/**
	 * Create a new authentication controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('guest', ['except' => 'getLogout']);
	}
	/**
	 * Get a validator for an incoming registration request.
	 *
	 * @param  array  $data
	 * @return \Illuminate\Contracts\Validation\Validator
	 */
	protected function validator(array $data) {
		return Validator::make($data, [
			'clock_number' => 'required|max:4',
			'email' => 'required|email|max:255|unique:users',
			'password' => 'required|confirmed|min:6',
			'first_name' => 'required|max:255',
			'last_name' => 'required|max:255',
			'phone' => 'required|max:255',
			'dob' => 'required|date',
			'alt_email' => 'required|email|max:255',
			'identifies_as' => 'required'
		]);
	}
	/**
	 * Create a new user instance after a valid registration.
	 *
	 * @param  array  $data
	 * @return User
	 */
	protected function create(array $data) {
		return User::create([
			'role_id' => 3,
			'clock_number' => $data['clock_number'],
			'email' => $data['email'],
			'password' => bcrypt($data['password']),
			'first_name' => $data['first_name'],
			'last_name' => $data['last_name'],
			'phone' => $data['phone'],
			'dob' => $data['dob'],
			'alt_email' => $data['alt_email'],
			'identifies_as' => $data['identifies_as'],
			'mem_status' => 'Pending',
			'mem_type' => 'Skater'
		]);
	}
}
