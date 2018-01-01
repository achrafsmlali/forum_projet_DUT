<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model {

	// Post __belongs_to__ User
	public function user(){
		return $this->belongsTo('App\User');
	}
	public function categorie(){
		return $this->belongsTo('App\Categorie');
	}
	public function tags(){
		return $this->belongsToMany('App\Tag');
	}

public function get_po_vote($id){
	$nbr = \DB::table('posts')
            ->join('post_votes', 'posts.id', '=', 'post_votes.post_id')
            ->where('posts.id','=',$id)
		    ->where('vote','=','1')->count();           
		    return $nbr;
							}


public function get_neg_vote($id){
	$nbr = \DB::table('posts')
            ->join('post_votes', 'posts.id', '=', 'post_votes.post_id')
            ->where('posts.id','=',$id)
             ->where('vote','=','0')->count();
             return $nbr;
         }

         
}
