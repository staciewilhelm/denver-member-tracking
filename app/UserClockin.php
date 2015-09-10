<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserClockin extends Model {

	// Use the time_entries table
	protected $table = 'user_clockins';

	// An array of the fields we can fill in the time_entries table
	protected $fillable = ['user_id', 'calendar_date', 'calendar_time', 'clock_number'];

	protected $hidden = ['user_id'];

	// Eloquent relationship that says one user belongs to each time entry
	public function user()
	{
		return $this->belongsTo('App\User');
	}

}
