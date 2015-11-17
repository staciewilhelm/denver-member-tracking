<?php

namespace App\Http\Controllers\Members;

use App\Http\Controllers\Controller;
use App\Services\GoogleCalendar;
use App\Services\GoogleDirectory;
use App\Services\Venmo;
use Illuminate\Routing\Router;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Collection;
use DateTime;




use DB;

use App\User;
use App\Committee;
use App\Group;
use App\Position;
use App\Requirement;
use App\Role;
use App\Team;

class MemberController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Member Controller
	|--------------------------------------------------------------------------
	|
	| The base for most of the DRD Tracking system
	|
	*/

	/**
	 * Create a new controller instance.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->middleware('auth');
	}

/**
 * Member Methods
 */

	/**
	 * Returns an array of merged events from both the
	 * Practices & Bouts and Activities & Events calendars
	 *
	 * @param App\Services\GoogleCalendar   $calendar
	 * @param App\Services\GoogleDirectory  $directory
	 * @return array
	 */
	public function dashboard(GoogleCalendar $calendar, GoogleDirectory $directory) {
		$user = User::where('id', \Auth::user()->id)->first();

		$user->last_logged = $this->formatDateTime($user->last_logged, 'datetime', 'display');

		// related tables
		$committees = Committee::where('active', 1)->orderBy('name')->get();
		$positions = Position::all();
		$teams = Team::where('active', 1)->orderBy('name')->get();

		$rawReqs = DB::table('requirements')
			->select(DB::raw('requirements.*, teams.name as team_name, (select
					sum(practice) from requirements as reqs2
					where
						reqs2.team_id = requirements.team_id and reqs2.requirement_type_id = requirements.requirement_type_id 
					group by reqs2.team_id) as total'))
			->leftJoin('teams', 'requirements.team_id', '=', 'teams.id')
			->whereRaw('year = YEAR(NOW())')
			->orderBy('total', 'DESC')
			->orderBy('quarter')
			->get();

		$requirements = Collection::make($rawReqs);

		$groups = Group::orderBy('name')->get();
		$roles = Role::orderBy('name')->get();

		// determine whether the authenticated user is the captain / coach of a team
		$isCaptain = $user->teams()->where('is_captain', 1)->first();
		$isCoach = $user->teams()->where('is_coach', 1)->first();

		$teamClockinsStandings = null;
		// if they are, grab all related users attendance / standings for roster decisions
		if (!empty($isCaptain) || !empty($isCoach)) {

			// get users in team

			$user->teamClockinsStandings = $this->usersQuarterRequirements($user->teams);
			//dd($user->teamClockinsStandings);
		}

		return view('dashboard')->with(compact('user', 'committees', 'positions', 'requirements', 'teams', 'groups', 'roles'));

	}

	/**
	 * Return logged practices for logged in member
	 *
	 * @return array
	 */
	public function loggedPractices() {

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
	public function loggedActivities() {

		return view('logged.activities');
	}



	/**
	 * Return data for all members within the system
	 *
	 * @return array
	 */
	public function getMembers(Router $router) {
		$uri = $router->getCurrentRoute()->uri();

		$users = User::whereRaw('id != 1')->orderBy('created_at')->get();

		return view('members.list', compact('uri', 'users'));
	}

	/**
	 * Returns data for one user by id
	 *
	 * @param number  $account_id
	 * @return array
	 */
	public function view($account_id) {
		return view('members.view');
	}

	/**
	 * Update a user by id
	 *
	 * @param number  $account_id
	 * @param Request $request
	 * @return array
	 */

	public function edit($account_id, Request $request) {
		/*
		// grab clockins for admins
		$team_ids = array();
		foreach ($user->teams as $value) {
			$team_ids[] = $value->id;
		}

		$rawTeamUsers = DB::table('users_teams')
			->select(DB::raw('users.id, users.first_name, users.last_name, users.skater_name,
				GROUP_CONCAT(DISTINCT teams.name ORDER BY teams.name SEPARATOR \', \') as teams,
				(SELECT COUNT(id) FROM user_clockins WHERE users.id = user_clockins.user_id and user_clockins.type = \'practice\') as practices,
				(SELECT COUNT(id) FROM user_clockins WHERE users.id = user_clockins.user_id and user_clockins.type = \'scrimmage\') as scrimmages,
				(SELECT COUNT(id) FROM user_clockins WHERE users.id = user_clockins.user_id and user_clockins.type = \'activity\') as activities,
				(SELECT COUNT(id) FROM user_clockins WHERE users.id = user_clockins.user_id and user_clockins.type = \'facility\') as facitilies,
				(SELECT COUNT(id) FROM user_clockins WHERE users.id = user_clockins.user_id and user_clockins.type = \'bout\') as bout,
				(SELECT COUNT(id) FROM user_clockins WHERE users.id = user_clockins.user_id and user_clockins.type = \'scrimmage\') as committees'))
			->leftJoin('users', 'users_teams.user_id', '=', 'users.id')
			->leftJoin('teams', 'users_teams.team_id', '=', 'teams.id')
			->whereRaw('team_id IN ('.implode(',', $team_ids).')')
			->groupBy('users.id')
			->get();


		*/


		$user = User::find($account_id);

		if ($request->isMethod('put')) {

			$dates = array('dob', 'join_date', 'induction_date', 'transfer_date', 'retired_date');

			$input = $request->all();
			foreach ($input as $field=>$val) {

				if (is_array($val)) {
					//var_dump('it is an array! the field: ', $field, ', the val: ', $val);
					
					if (strpos($field, 'activeStanding') === 0) {
						$this->updateStandings($val, $user);
					}

					if (strpos($field, 'teams') === 0) {
						$this->updateTeams($val, $user);
					}

					if (strpos($field, 'user_committees') === 0) {
						$this->updateCommittees($val, $user);
					}

					if (strpos($field, 'user_positions') === 0) {
						$this->updatePositions($val, $user);
					}

					if (strpos($field, 'user_requirements') === 0) {
						$this->updateRequirements($val, $user);
					}

				} else {
					// format dates
					if (in_array($field, $dates)) $input[$field] = $this->formatDateTime($val);

					//echo 'key: '.$field.', val: '.$val.'<br /><br />';

				}

				
				
				
			}


			//dd('fin');
			dd($input);

			$user->update($input);
			

			/*
				$activation->user->activated = true;

        $activation->user->save();

				$user->clockins
				$user->standings
				$user->transactions

				$user->committees
				$user->positions
				$user->requirements
				$user->teams

			*/

			//$user->push($input);

			//return Redirect::route('members.list')->with('message', 'Your list has been created!');
			return redirect('members')->with('message', 'YEAH GOOD JOB');

		// once sync is complete, show a list of newly added members
		// note on the list page newly added members (use the star?)
		} else {
			// related tables
			$committees = Committee::where('active', 1)->orderBy('name')->get();
			$positions = Position::all();
			$teams = Team::where('active', 1)->orderBy('name')->get();

			$requirements = $this->currentYearBaseReqs();

			$groups = Group::orderBy('name')->get();
			$roles = Role::orderBy('name')->get();

			/*
			on create, make sure a user_requirements record exists

			*/

			return view('members.edit')->with(compact('user', 'committees', 'positions', 'requirements', 'teams', 'groups', 'roles'));

		} // end request->isPut

	} // end edit

/**
 * Payment Methods
 */

	/**
	 * Return Venmo Authorization Token based on returned code
	 *
	 * @return array
	 */
	public function authorized(Request $request, Venmo $venmo) {

		$result = $venmo->accessToken($request->code);
		$response = json_decode($result);

		// set token and refresh token in session
		$request->session()->put('vToken', $response->access_token);
		$request->session()->put('vRefreshToken', $response->refresh_token);

		return redirect('payments');
	}

	/**
	 * Return all transactions for @denverrollerderby
	 *
	 * @return array
	 */
	public function transactions(Request $request, Venmo $venmo) {

		$result = $venmo->getPayments($request->session()->get('vToken'));
		$response = json_decode($result);

		dd($response);

		return view('members.payments');
	}

/**
 * Protected functions
 */

	protected function formatDateTime($date, $dateType = 'date', $dataType = 'save') {
		if ($dataType === 'save') {
			$filteredDate = new DateTime($date);

			if ($dateType === 'datetime') return $filteredDate->format('Y-m-d H:i:s');
			if ($dateType === 'date') return $filteredDate->format('Y-m-d');
		}

		if ($dataType === 'display') return date('U', strtotime($date)) * 1000;
	}

	protected function currentQtr() {
		$n = date('n');
		switch ($n) {
			case $n < 4:
				return 1;
				break;
			case ($n > 3 && $n < 7):
				return 2;
				break;
			case ($n > 6 && $n < 10):
				return 3;
				break;
			case ($n > 9):
				return 4;
				break;
		}
	}

	protected function currentYearBaseReqs($teamIds = null, $qtrs = null) {
		$where = 'year = YEAR(NOW())';
		if (!empty($teamIds)) {
			$where .= ' AND (team_id IN ('.implode(',', $teamIds).') OR team_id IS NULL)';
		} else {
			$where .= ' AND team_id IS NULL';
		}

		if (!empty($qtrs)) {
			$where .= ' AND quarter IN ('.implode(',', $qtrs).')';
		}

		$rawReqs = DB::table('requirements')
			->select(DB::raw('requirements.*, teams.name as team_name, (select
					sum(practice) from requirements as reqs2
					where
						reqs2.team_id = requirements.team_id and reqs2.requirement_type_id = requirements.requirement_type_id 
					group by reqs2.team_id) as total'))
			->leftJoin('teams', 'requirements.team_id', '=', 'teams.id')
			->whereRaw($where)
			->orderBy('total', 'DESC')
			->orderBy('quarter')
			->get();

		return Collection::make($rawReqs);
	}

	protected function usersQuarterRequirements($loggedUsersTeams) {
		$finalReqs = array();

		// setup queries for captains/coaches
		$teamIds = array();
		foreach ($loggedUsersTeams as $team) {
			$teamIds[] = $team->id;
		}

		// get all the base requirements
		$allBaseReqs = $this->currentYearBaseReqs($teamIds, array($this->currentQtr(), ($this->currentQtr() - 1)));

		//dd($allBaseReqs);

		// set all team base requirements
		$teamBaseReqs = array();
		foreach ($allBaseReqs as $key => $req) {
			$team = empty($req->team_id) ? 'League' : $req->team_id;
			$teamBaseReqs[$team][$req->quarter] = $req;

			if (!empty($req->team_id)) {
				if (!isset($finalReqs[$req->team_id])) $finalReqs[$req->team_id] = array();
				$finalReqs[$req->team_id][$req->quarter] = array();
			}
		}

		//dd($finalReqs);

		//dd($teamBaseReqs);

		// calculate the base requirements for a user per the league/teams they're on
		$calcBaseReqs = $this->calculateUserBaseReqs($allBaseReqs);

		$baseReqs = array();
		$types = array();
		foreach ($calcBaseReqs as $qtr => $reqs) {
			foreach ($reqs as $reqType => $req) {
				$types[] = $reqType;
				$baseReqs[$qtr][$reqType] = $req;
			}
		}

		// query all the users that are within the user teams
		$rawUserTeams = DB::table('users_teams')
			->select('users_teams.*', 'users.skater_name', 'users.first_name')
			->leftJoin('users', 'users.id', '=', 'users_teams.user_id')
			->whereRaw('team_id IN ('.implode(',', $teamIds).')')
			->get();

		$userTeams = Collection::make($rawUserTeams);

		//dd($userTeams);

		$teams = $unsortedUsers = $userIds = array();
		foreach ($userTeams as $user) {
			if (isset($unsortedUsers[$user->user_id])) {
				$unsortedUsers[$user->user_id]->teams[] = $user->team_id;
			} else {
				$user->teams = array($user->team_id);
				$user->name = is_null($user->skater_name) ? $user->first_name : $user->skater_name;
				unset($user->first_name, $user->skater_name);
				$unsortedUsers[$user->user_id] = $user;
			}

			$teams[$user->team_id][$user->user_id] = $user;
			if (!in_array($user->user_id, $userIds)) $userIds[] = $user->user_id;
		}


		$sortArray = array(); 
		foreach ($unsortedUsers as $user) { 
			foreach ($user as $key=>$value) {
				if (!isset($sortArray[$key])) $sortArray[$key] = array(); 
				$sortArray[$key][] = $value; 
			}
		} 

		array_multisort($sortArray['name'],SORT_ASC,$unsortedUsers); 

		//dd($unsortedUsers);

		$users = array();
		foreach ($unsortedUsers as $key => $user) {
			$users[$user->user_id] = $user;
		}

		//dd($users);

		// query all users, associated to logged in user's teams, custom user requirements
		$rawUserReqs = DB::table('user_requirements AS userReqs')
			->select(DB::raw('userReqs.*, users.first_name, users.last_name, users.email, users.skater_name,
				(SELECT type FROM user_standings WHERE 
					user_standings.user_id = userReqs.user_id AND (end_date IS NULL OR end_date > NOW())
					ORDER BY end_date DESC limit 1
				) as standing'))
			->leftJoin('users', 'users.id', '=', 'userReqs.user_id')
			->whereRaw('userReqs.user_id IN ('.implode(',', $userIds).') 
					AND userReqs.quarter IN ('.($this->currentQtr().','.($this->currentQtr() - 1)).')')
			->orderBy('users.skater_name')
			->get();

		$userReqs = Collection::make($rawUserReqs);

		//dd($userReqs);

		$formattedUserReqs = array();
		foreach ($userReqs as $key => $userReq) {
			$formattedUserReqs[$userReq->quarter][$userReq->user_id] = $userReq;
		}

		//dd($formattedUserReqs);

		// each user should have at least one user_requirements record for the active quarter
		// in which their user record was created. null values mean there is no set requirements
		// at a user level, so the default would be the team OR at the minimum, the league
		// requirements

		$debug = false;

		// loop through user requirements and calculated 
		// teams -> quarter -> user -> count/requirements
		foreach ($formattedUserReqs as $qtr => $qtrUserReq) {
			foreach ($qtrUserReq as $userReq) {

				//var_dump($userReq);
				//echo '<br /><br />';

				foreach ($types as $type) {
					$req = 'min_'.$type;
					$count = $type.'_count';

					if ($debug) {
						echo '<br />';
						echo 'the user: '.$userReq->user_id.'<br />';
						echo 'the type: '.$type.'<br />';
						echo 'the qtr: '.$userReq->quarter.'<br /> ------- <br />';
						echo 'user req: '.$userReq->$req.'<br /> ------- <br />';
					}

					// if the user requirement is null, go on to league requirements
					// if NOT null, use the user requirements
					$remaining = 0;
					foreach ($users[$userReq->user_id]->teams as $key => $team_id) {
						$remaining = $teamBaseReqs[$team_id][$userReq->quarter]->$type;
						if (!is_null($userReq->$req)) $remaining = $userReq->$req;

						if (!isset($finalReqs[$team_id][$userReq->quarter][$userReq->user_id]['user'])) {
							$finalReqs[$team_id][$userReq->quarter][$userReq->user_id]['user'] = array(
								'first_name' => $userReq->first_name,
								'last_name' => $userReq->last_name,
								'skater_name' => $userReq->skater_name,
								'email' => $userReq->email,
								'standing' => (is_null($userReq->standing) ? 'Active' : $userReq->standing),
							);
						}

						// set standing based on QUARTER
						$finalReqs[$team_id][$userReq->quarter][$userReq->user_id][$type] = array('attended'=>$userReq->$count, 'remaining'=>$remaining);

						if ($debug) echo 'team '.$team_id.' req: '.$teamBaseReqs[$team_id][$userReq->quarter]->$type.'<br />';
					}

					if ($debug) {
						echo 'league req: '.$teamBaseReqs['League'][$userReq->quarter]->$type.'<br /> ------- <br />';
						echo 'base req: '.$baseReqs[$userReq->quarter][$type].'<br />';
						echo '----<br />user count/attended: '.$userReq->$count.'<br />';
						echo '<br />';
					}

				} // foreach type

			} // foreach userreq

		} // foreach formatteduserreq

		//dd($finalReqs);

		return $finalReqs;
	}

	protected function calculateUserBaseReqs($allBaseReqs) {
		$types = array('practice', 'scrimmage', 'activity', 'facility', 'bout', 'committee');

		$requirements = array();
		// loop through all returned requirements to calculate which is the base league/team requirements
		foreach ($types as $type) {
			foreach ($allBaseReqs as $key => $teamReq) {
				if (!isset($requirements[$teamReq->quarter][$type]))
					$requirements[$teamReq->quarter][$type] = $teamReq->$type;
				// if the new count is greater than what's currently set,
				// set larger count as base requirement
				if ($teamReq->$type > $requirements[$teamReq->quarter][$type])
					$requirements[$teamReq->quarter][$type] = $teamReq->$type;
			}
		}

		return $requirements;
	}

	protected function updateCommittees($data, $user) {
		$detach = $attach = array();

		foreach ($user->committees as $c => $currentC) {
			$detach[] = $currentC->id;
		}
		$user->committees()->detach($detach);

		foreach ($data as $key => $committee) {
			$attach[] = $committee;
		}
		$user->committees()->attach($attach);
	}

	protected function updatePositions($data, $user) {
		$detach = $attach = array();

		foreach ($user->positions as $c => $currentP) {
			$detach[] = $currentP->id;
		}
		$user->positions()->detach($detach);

		foreach ($data as $key => $position) {
			$attach[] = $position;
		}
		$user->positions()->attach($attach);
	}

	protected function updateTeams($data, $user) {
		$detach = $attach = array();

		foreach ($user->teams as $c => $currentT) {
			$detach[] = $currentT->id;
		}
		$user->teams()->detach($detach);

		foreach ($data as $key => $team) {
			$new = array(
				'is_captain'=> (isset($team['is_captain']) ? 1 : 0), 
				'is_coach'=> (isset($team['is_coach']) ? 1 : 0)
			);
			$attach[$team['id']] = $new;
		}
		$user->teams()->attach($attach);
	}

	protected function updateRequirements($data, $user) {
		$reqData = array();
		foreach ($data as $type => $qtrVals) {
			foreach ($qtrVals as $qtr => $count) {
				if (isset($count['amended']) && $count['amended'] !== '') {
					$reqData[$qtr]['id'] = $count['id'];
					$reqData[$qtr]['min_'.$type] = $count['amended'];
				}
			}
		}

		foreach ($reqData as $key => $value) {
			$req = $user->requirements()->where('id', $value['id'])->firstOrFail();
			if (isset($value['min_practice'])) $req->min_practice = $value['min_practice'];
			if (isset($value['min_scrimmage'])) $req->min_scrimmage = $value['min_scrimmage'];
			if (isset($value['min_activity'])) $req->min_activity = $value['min_activity'];
			if (isset($value['min_facility'])) $req->min_facility = $value['min_facility'];
			if (isset($value['min_bout'])) $req->min_bout = $value['min_bout'];
			if (isset($value['min_committee'])) $req->min_committee = $value['min_committee'];

			$req->save();
		}
	}

	protected function updateStandings($data, $user) {
		$standing = $user->standings()->where('id', $data['id'])->firstOrFail();

		$standing->type = $data['type'];
		$standing->start_date = !empty($data['start_date']) ? $this->formatDateTime($data['start_date']) : null;
		$standing->end_date = !empty($data['end_date']) ? $this->formatDateTime($data['end_date']) : null;
		$standing->notes = $data['notes'];

		$standing->save();
	}

}
