<?php namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract, CanResetPasswordContract {

	use Authenticatable, CanResetPassword;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['first_name', 'last_name', 'email', 'password', 'clock_number', 'role_id', 'phone', 
												'dob', 'alt_email', 'identifies_as'];

	/**
	* The attributes that should be mutated to dates.
	*
	* @var array
	*/

	/*protected $dates = [
		'created_at', 
		'updated_at', 
		'last_logged'
	];*/

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = ['password', 'remember_token', 'created_at', 'updated_at'];

	/**
	 * Various Relationships
	 */
	/* hasOne */
	public function group() {
		return $this->hasOne('App\Group', 'id', 'group_id');
	}

	public function role() {
		return $this->hasOne('App\Role', 'id', 'role_id');
	}

	/* belongsToMany */
	public function committees() {
		return $this->belongsToMany('App\Committee', 'users_committees', 'user_id', 'committee_id')->withTimestamps();
	}

	public function positions() {
		return $this->belongsToMany('App\Position', 'users_positions', 'user_id', 'position_id')->withTimestamps();
	}

	public function teams() {
		return $this->belongsToMany('App\Team', 'users_teams', 'user_id', 'team_id')->withPivot('is_captain', 'is_coach');
	}

	/* hasMany */
	public function clockins() {
		return $this->hasMany('App\UserClockin')->orderBy('clocked', 'DESC');
	}

	public function validClockins() {
		return $this->hasMany('App\UserClockin')->whereRaw('invalid = 0 AND QUARTER(calendar_date) = QUARTER(NOW())')->orderBy('clocked', 'DESC');
	}

	public function requirements() {
		return $this->hasMany('App\UserRequirement')->whereRaw('year = YEAR(NOW())')->orderBy('quarter');
	}

	public function standings() {
		return $this->hasMany('App\UserStanding')->with('admin')->orderBy('updated_at', 'DESC');
	}

	public function transactions() {
		return $this->hasMany('App\UserTransaction')->orderBy('due', 'DESC');
	}

	/**
	 * Role specific functions
	 */
	public function hasRole($roles) {
		$this->have_role = $this->getUserRole();
		// Check if the user is a root account
		if($this->have_role->name == 'Root') {
			return true;
		}

		if(is_array($roles)){
			foreach($roles as $need_role){
				if($this->checkIfUserHasRole($need_role)) {
					return true;
				}
			}
		} else{
			return $this->checkIfUserHasRole($roles);
		}
		return false;
	}

	private function getUserRole() {
		return $this->role()->getResults();
	}

	private function checkIfUserHasRole($need_role) {
		return (strtolower($need_role)==strtolower($this->have_role->name)) ? true : false;
	}

}
