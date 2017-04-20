<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	// Post __belongs_to__ User
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function categories(){
		return $this->belongsTo('App\Categorie');
	}
	public function tags(){
		return $this->belongsToMany('App\Tag');
	}
}
