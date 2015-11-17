<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserClockin extends Model {

	// Use the time_entries table
	protected $table = 'user_clockins';

	// An array of the fields we can fill in the time_entries table
	protected $fillable = ['user_id', 'clock_number', 'type', 'calendar_date', 'calendar_time', 'clocked',
												'duplicate', 'late_clockin', 'late_clockin_note', 'invalid', 'invalid_desc'];

	protected $hidden = ['user_id', 'created_at', 'updated_at'];

	// Eloquent relationship that says one user belongs to each time entry
	public function user() {
		return $this->belongsTo('App\User');
	}

}
