<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class RequirementType extends Model {

	protected $table = 'requirement_types';

	public function requirements() {
		return $this->hasMany('App\Requirement');
	}

}