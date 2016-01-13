<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Team extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	//protected $table = 'teams';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['name', 'abbr'];

	public function requirements() {
		return $this->hasMany('App\Requirement', 'team_id', 'id');
	}

	public function users() {
		return $this->belongsToMany('App\User', 'users_teams', 'team_id', 'user_id');
	}

}