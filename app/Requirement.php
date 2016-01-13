<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'requirements';

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = ['requirement_type_id', 'team_id', 'year', 'quarter', 'practice', 'scrimmage', 'activity', 
												'committee', 'facility', 'bout'];

	public function type() {
		return $this->hasOne('App\RequirementType', 'id', 'requirement_type_id');
	}

	public function team() {
		return $this->hasOne('App\Team', 'id', 'team_id');
	}

}