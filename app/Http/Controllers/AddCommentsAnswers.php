<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AddCommentsAnswers extends Controller {

	public function create(Request $request)
	{
		$type=$request->input('_type');
		if ($request->input('r_type')!='' || $request->input('r_type')!=null) {
			$type=$request->input('r_type');
		}
		if ($type=="comment"){
			$this->validate($request, [
			    'c_post'     => 'required',
			    'c_user'     => 'required',
			    'c_content'  => 'required',
			    'c_relative' => 'required',
			    'c_answer'   => 'required',
			]);
			$comment = new \App\Comment;
			$comment->post_id=$request->input('c_post');
			$comment->user_id=$request->input('c_user');
			$comment->content=$request->input('c_content');
			if ($request->input('c_relative')=='1') {
				$comment->relative_to_sujet=1;
			} else {
				$comment->answer_id=$request->input('c_answer');
			}			
			$comment->save();
			if ($request->input('c_relative')=='1'){
				return "comment";
			}else{
				return "answer";
			}
		}
		elseif ($type=="answer") {
			$this->validate($request, [
			    'a_post'    => 'required',
			    'a_user'    => 'required',
			    'a_content' => 'required',
			]);
			$answer = new \App\Answer;
			$answer->content= $request->input('a_content');
			$answer->user_id= $request->input('a_user');
			$answer->post_id= $request->input('a_post');
			$answer->save();
		} 
	}
	public function solution(Request $request)
	{
		$array = array();
		$ans = \App\Answer::find($request->input('id'));
		if ($ans->best==0) {
			$count = \App\Answer::where('post_id','=',$ans->post_id)->where('best','=','1')->count();
			if ($count==0) {
				$ans->best ="1";
				$ans->save();
				$array[]=$ans->id;
				$array[]="Vous avez marquer cette réponse au tant que la meilleur réponse";
				return $array;
			} else {
				\App\Answer::where('post_id','=',$ans->post_id)->where('best','=','1')->update(['best' => 0]);
				$ans->best ="1";
				$ans->save();
				$array[]=$ans->id;
				$array[]="Vous avez editer la meilleur réponse de cette sujet";
				return $array;
			}
			
		} else {
			$ans->best=0;
			$ans->save();
			$array[]=$ans->id;
			$array[]="Vous avez décocher cette réponse au tant que meilleur réponse";
			return $array;
		}
		
	}

	// delete post coment and answer

	public function deleteanswer(Request $request)
	{
		$ans = \App\Answer::destroy($request->input('id'));
	}

	public function deletecomment(Request $request)
	{
		$ans = \App\Comment::destroy($request->input('id'));
	}

	public function deletepost(Request $request)
	{
		$ans = \App\Post::destroy($request->input('id'));
		return redirect('http://localhost:8080/');
	}

	// edit comments answers

	public function editanswer(Request $request)
	{
		
	}	


	public function editcomment(Request $request)
	{
		
	}

}
