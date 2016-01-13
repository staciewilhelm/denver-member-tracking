<?php

/*
|--------------------------------------------------------------------------
| Tag Setup
|--------------------------------------------------------------------------
|
| Since Angular uses {{ }} for it's content, we will set the Form/HTML
| helper tags as [{ }] and the Blade content tags as [[ ]] (because it's
| not confusing enough)
|
*/

//Blade::setRawTags('[{', '}]'); // for form/html tags
Blade::setContentTags('[[', ']]'); // controller data
Blade::setEscapedContentTags('[[[', ']]]');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*App::missing(function ($exception) {
    return Response::view('404', array(), 404);
});*/

Route::group(['prefix'=>'/'], function () {
	Route::get('/', 'GuestController@index');

	Route::get('/clock-in/thanks', 'GuestController@clockin');
	Route::get('/clock-in', 'GuestController@clockin');
	Route::post('/clock-in', 'GuestController@clockin');

	Route::get('/waiver', 'GuestController@waiver');
	Route::post('/waiver', 'GuestController@waiver');
});


/*
|--------------------------------------------------------------------------
| Authenticated Routes
|--------------------------------------------------------------------------
|
| Routes that live behind authentication: email and 5 digit code
| for now, we will only ever import members from Google and delete
| them within Google this system will only allow members to be marked
| as inactive
|
*/

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

// http://laravel.com/docs/5.1/controllers
// http://laravel.com/docs/5.1/middleware
// http://laravelcoding.com/blog/laravel-5-beauty-starting-the-admin-area
// https://gist.github.com/drawmyattention/8cb599ee5dc0af5f4246

Route::group([
	'middleware'=>['auth', 'roles'],
	'roles'=>['admin', 'member']
], function () {
	// landing page for all members once logged in
	Route::get('/dashboard', 'Members\MemberController@dashboard');


/*
	Route::get('/practices', 'Members\MemberController@loggedPractices');

	Route::get('/credits', 'Members\MemberController@loggedcredits');

	Route::get('/payments', 'Members\MemberController@loggedPayments');
*/



	// Admin Only routes
	Route::group(['roles'=>'admin'], function () {
		/*Route::group(['namespace' => 'User'], function() {
			// Controllers Within The "App\Http\Controllers\Admin\User" Namespace
    });*/

		// routes for a specific member
		Route::group(['prefix' => 'members/{account_id}'], function () {
			// Matches the members/{account_id}/detail URL
			Route::get('details', 'Members\MemberController@view');

			// Matches the members/{account_id}/payments URL
			Route::get('payments', 'Members\MemberController@payments');

			// Matches the members/{account_id}/update URL
			Route::get('update', 'Members\MemberController@edit');
			Route::put('update', 'Members\MemberController@edit');

		});
		// end members/{account_id} routing

		// routes for member listing
		Route::group(['prefix' => 'members'], function () {
			// Matches the members URL
			Route::get('/', 'Members\MemberController@listMembers');

			Route::get('create', 'Members\MemberController@create');
			Route::post('create', 'Members\MemberController@create');

			// Matches the members/sync URL
			/*Route::get('sync', 'Members\GoogleController@sync');
			Route::post('sync', 'Members\GoogleController@sync');*/
		});
		// end members routing

		Route::get('/payments/redirect', 'Members\MemberController@authorized');
		Route::get('/payments', 'Members\MemberController@transactions');

		Route::get('reports', 'ReportsController@listReports');
		Route::get('requirements', 'RequirementsController@index');
		Route::get('transactions', 'UserTransactionsController@index');

		// admin only API routes
		Route::post('api/requirements', 'RequirementsController@store');
		Route::put('api/requirements/{id}', 'RequirementsController@update');
		Route::delete('api/requirements/{id}', 'RequirementsController@destroy');

		Route::post('api/transactions', 'UserTransactionsController@store');
		Route::put('api/transactions/{id}', 'UserTransactionsController@update');
		Route::delete('api/transactions/{id}', 'UserTransactionsController@destroy');

		Route::get('api/usersAutocomplete', 'UsersController@autocompleteUsers');
		Route::resource('api/usersRequirements', 'UsersController@getUsersRequirements');

	});
	// end admin only routes

});

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Used throughout the system to retrieve data from various tables
|
*/

Route::group(['prefix' => 'api'], function () {
	/*
	https://scotch.io/tutorials/build-a-time-tracker-with-laravel-5-and-angularjs-part-1
	https://scotch.io/tutorials/build-a-time-tracker-with-laravel-5-and-angularjs-part-2
	*/

	Route::resource('clockins', 'UserClockinsController');
	Route::resource('clockNumbers', 'UsersController@clockNumbers');

	// Matches the api/practices URL
	Route::get('upcomingEvents', 'Members\GoogleController@upcomingEvents');

	// Matches the api/committees URL
	Route::get('committees', 'DenverApiController@committees');

	Route::get('member-types', 'DenverApiController@memberTypes');

});

