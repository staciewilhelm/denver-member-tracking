<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class UserTransaction extends Model {

	// Use the time_entries table
	protected $table = 'user_transactions';

	// An array of the fields we can fill in the time_entries table
	protected $fillable = ['user_id', 'type', 'desc', 'amount', 'due', 'paid', 'paid_date'];

	protected $hidden = ['user_id', 'created_at', 'updated_at'];

	// Eloquent relationship that says one user belongs to each time entry
	public function user() {
		return $this->belongsTo('App\User');
	}

}
