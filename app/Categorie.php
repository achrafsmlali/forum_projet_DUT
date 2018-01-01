<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Categorie extends Model {

	public function posts(){
		return $this->hasMany('App\Post');
	}
	public function last_post($id){

		$post=\App\Post::where('catg_id','=',$id)->orderBy('created_at', 'desc')->first();

		return $post;

	}
}
