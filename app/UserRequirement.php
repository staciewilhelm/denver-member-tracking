<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRequirement extends Model {

	// Use the time_entries table
	protected $table = 'user_requirements';

	// An array of the fields we can fill in the time_entries table
	protected $fillable = ['user_id', 'year', 'quarter', 'min_practice', 'practice_count', 'min_scrimmage', 'scrimmage_count', 
												'min_activity', 'activity_count', 'min_facility', 'facility_count', 'min_bout', 'bout_count',
												'min_committee', 'committee_count'];

	protected $hidden = ['user_id', 'created_at', 'updated_at'];

	// Eloquent relationship that says one user belongs to each time entry
	public function user() {
		return $this->belongsTo('App\User');
	}

}
