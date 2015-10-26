<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Committee extends Model {

	protected $table = 'committees';

	public function users() {
		return $this->belongsToMany('App\User', 'users_committees', 'user_id', 'committee_id');
	}

}