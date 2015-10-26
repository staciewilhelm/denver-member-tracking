<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserStanding extends Model {

	// Use the time_entries table
	protected $table = 'user_standings';

	// An array of the fields we can fill in the time_entries table
	protected $fillable = ['user_id', 'type', 'start_date', 'end_date', 'notes', 'admin_user_id'];

	protected $hidden = ['user_id', 'created_at', 'updated_at'];

	// Eloquent relationship that says one user belongs to each time entry
	public function user() {
		return $this->belongsTo('App\User');
	}

	public function admin() {
		return $this->belongsTo('App\User', 'admin_user_id');
	}

}
