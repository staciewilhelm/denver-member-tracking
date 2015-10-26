<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Requirement extends Model {

	protected $table = 'requirements';

	public function type() {
		return $this->belongsTo('App\RequirementType');
	}

	public function team() {
		return $this->belongsTo('App\Team');
	}

}