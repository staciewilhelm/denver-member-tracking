<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Position extends Model {

	protected $table = 'positions';

	public function users() {
		return $this->belongsToMany('App\User', 'users_positions', 'user_id', 'position_id');
	}

}