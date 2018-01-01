<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class VoteController extends Controller {
	/*public function __construct(){
		$this->middleware('auth');
	}*/

	public function post_up(Request $request)
	{	
			$raa=$request->input('_user');
			if ($raa=='null') {
				return 'false';
			}else{
			$already_vote = \App\Post_vote::where('user_id','=',$request->input('_user'))->where('post_id','=',$request->input('_post'))->count();
				if ($already_vote==0) {
					$post = new \App\Post_vote;
					$post->post_id=$request->input('_post');
					$post->user_id=$request->input('_user');
					$post->vote=1;
					$post->save();
		        	return 'true';
		        }else{
		        	return 'false2';
		        }
		    }
	}


	public function post_down(Request $request)
	{	
			$raa=$request->input('_user');
			if ($raa=='null') {
				return 'false';
			}else{
			$already_vote = \App\Post_vote::where('user_id','=',$request->input('_user'))->where('post_id','=',$request->input('_post'))->count();
				if ($already_vote==0) {
					$post = new \App\Post_vote;
					$post->post_id=$request->input('_post');
					$post->user_id=$request->input('_user');
					$post->vote=0;
					$post->save();
		        	return 'true';
		        }else{
		        	return 'false2';
		        }
		    }
	}


	public function answer_up(Request $request)
	{	
			$raa=$request->input('_user');
			if ($raa=='null') {
				return 'false';
			}else{
			$already_vote = \App\Answer_vote::where('user_id','=',$request->input('_user'))->where('answer_id','=',$request->input('_answer'))->count();
				if ($already_vote==0) {
					$post = new \App\Answer_vote;
					$post->answer_id=$request->input('_answer');
					$post->user_id=$request->input('_user');
					$post->vote=1;
					$post->save();
		        	return 'true';
		        }else{
		        	return 'false2';
		        }
		    }
	}
	public function answer_down(Request $request)
	{	
			$raa=$request->input('_user');
			if ($raa=='null') {
				return 'false';
			}else{
			$already_vote = \App\Answer_vote::where('user_id','=',$request->input('_user'))->where('answer_id','=',$request->input('_answer'))->count();
				if ($already_vote==0) {
					$post = new \App\Answer_vote;
					$post->answer_id=$request->input('_answer');
					$post->user_id=$request->input('_user');
					$post->vote=0;
					$post->save();
		        	return 'true';
		        }else{
		        	return 'false2';
		        }
		    }
	}

}
