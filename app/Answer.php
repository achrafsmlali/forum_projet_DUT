<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model {

	// Answer __belongs_to__ User
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function comments(){
		return $this->hasMany('App\Comment');
	}

}
