<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;

use Illuminate\Http\Request;

class PostController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	public function show($id)
	{
		$post = \App\Post::find($id);
		$post->views++;
		$post->save();
		$comments = \App\Comment::where('post_id','=',$id)->count();
		$recents = \App\Post::where('id','<>',$id)->where('catg_id','=',$post->catg_id)->orderBy('created_at', 'DESC')->paginate(5);
		$post_comments= \App\Comment::where('post_id','=',$id)->where('relative_to_sujet','=','1')->get();
		$post_answers= \App\Answer::where('post_id','=',$id)->get();
		$answers = \App\Answer::where('post_id','=',$id)->count();
		$related_posts_id=PostController::similar_tags($id,3);

		if (count($related_posts_id)<12) {
			$related_posts_id=PostController::similar_tags($id,2);
			if (count($related_posts_id)<12) {
				$related_posts_id=PostController::similar_tags($id,1);
			}
		}
		
		$related_posts=array();
		foreach ($related_posts_id as $value) {
			$related_posts[] = \App\Post::find($value);
		}
		
		return view('Pages.AffichagePost',compact('post','comments','answers','related_posts','post_answers','post_comments','recents'));
	}

	public static function similar_tags($id,$var)
	{
		$post = \App\Post::find($id);
		$all_posts = \App\Post::where('id','<>',$id)->where('catg_id','=',$post->catg_id)->get();
		$tab=array();
		$result=array();
		$tab2=array();
		$i=0;
		//table contient les tags de post courant
		foreach ($post->tags as $value) {
			$tab2[]=$value->name;
		}

		foreach ($all_posts as $value) {
			//table contient les tags d chaque post dans le meme categorie
			$tab3=array();
			foreach ($value->tags as $k) {
				$tab3[]=$k->name;
			}
			$tab[]= array_intersect($tab2, $tab3);
			if(count($tab[$i])>=$var){
				$result[]=$value->id;
			}
			$i++;
		}
		return $result;
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}

}
