<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PostController;
use DB;
use Request;

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


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function fetch_comments($id)
	{	
		$post_id=$id;
		$comments = \App\Comment::where('post_id','=',$id)->where('relative_to_sujet','=','1')->count();
		$post_comments= \App\Comment::where('post_id','=',$id)->where('relative_to_sujet','=','1')->paginate(10);
		return view('Pages.post_comments',compact('post_comments','comments','post_id'));
	}

	public function fetch_answers($id)
	{	
		$post_answers= \App\Answer::where('post_id','=',$id)->orderBy('best','desc')->paginate(10);
		$answers = \App\Answer::where('post_id','=',$id)->count();
		$pp= \App\Answer::where('post_id','=',$id)->get();
		$a_up = array();
		$a_down =array();
		foreach ($pp as $answer) {
			$a_up[$answer->id] = \App\Answer_vote::where('answer_id','=',$answer->id)->where('vote','=','1')->count();
			$a_down[$answer->id] = \App\Answer_vote::where('answer_id','=',$answer->id)->where('vote','=','0')->count();
		}
		$pp=null;
		$blolo = $id;
		$user_id = \App\Post::find($id);
		$user_id = $user_id->user_id;
		return view('Pages.post_answers',compact('a_up','a_down','post_answers','answers','blolo','user_id'));

	}
	

	public function show($id)
	{
		$post = \App\Post::find($id);
		$post->views++;
		$post->save();
		$comments = \App\Comment::where('post_id','=',$id)->where('relative_to_sujet','=','1')->count();
		$recents = \App\Post::where('id','<>',$id)->where('catg_id','=',$post->catg_id)->orderBy('created_at', 'DESC')->paginate(5);
		$post_answers= \App\Answer::where('post_id','=',$id)->orderBy('best','desc')->paginate(10);
		$pp= \App\Answer::where('post_id','=',$id)->get();
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
		$_up = \App\Post_vote::where('post_id','=',$id)->where('vote','=','1')->count();
		$_down = \App\Post_vote::where('post_id','=',$id)->where('vote','=','0')->count();

		$a_up = array();
		$a_down =array();
		foreach ($pp as $answer) {
			$a_up[$answer->id] = \App\Answer_vote::where('answer_id','=',$answer->id)->where('vote','=','1')->count();
			$a_down[$answer->id] = \App\Answer_vote::where('answer_id','=',$answer->id)->where('vote','=','0')->count();
		}
		$pp=null;

		$joins = \DB::table('answers')
            ->leftJoin('posts', 'answers.post_id', '=', 'posts.id')
            ->leftJoin('answer_votes', 'answer_votes.answer_id', '=', 'answers.id')
            ->leftJoin('users', 'answer_votes.user_id', '=', 'users.id')
            ->where('posts.id','=',$id)
            ->select('users.name as name ','users.image_link as image','answers.content as content', 'answers.id as answer_id','answers.created_at as time',\DB::raw('COUNT(answer_votes.answer_id) as votes'))
            ->groupBy('posts.id','posts.title','posts.content','answers.content','answer_votes.answer_id')
            ->orderBy('post_id','asc')
            ->orderBy('votes','desc')
            ->get();

		return view('Pages.AffichagePost',compact('joins','a_down','a_up','_down','_up','post','comments','answers','related_posts','post_answers','post_comments','recents'));
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


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function search()
	{
		$s = "%".$_GET['search']."%";
		$words = explode("+",strtolower($s));
		$posts = \App\Post::whereRaw('LOWER(content) like ?',$words)->paginate(20);
		$count_search = \App\Post::whereRaw('LOWER(content) like ?',$words)->count();
		return view('posts',compact('posts','s','words'));
	}

	public function showcat($categorie){

		 $id = \App\Categorie::where('nom','=',$categorie)->pluck('id');

		 if($id){
		 	$posts = \App\Post::where('catg_id','=',$id)->orderBy('created_at','desc')->paginate(20);
		 	return view("posts",compact('posts'));
		 }else{
		 	return '/';
		 }

}

	public function tagpost($tag)
	{
		$id=\App\Tag::where('name','=',$tag)->pluck('id');
		$tag =\App\Tag::find($id);
		$posts=$tag->posts()->paginate(20);
		 	return view("posts",compact('posts'));
	}
	public function update($id,Request $request)
	{
		$post = new \App\Post;
		$post = \App\Post::find($id);
		$title = Request::get('title');
		$content = Request::get('content');
		$post = \App\Post::find($id);
		$post->title = $title;
        $post->content = $content;
        $post->save();
        DB::table('post_tag')->where('post_id', '=', $id)->delete();


foreach (Request::get('tag_list') as $value) {
			$tagg = new \App\Tag;
			$tagId = \App\Tag::where('name','=',$value)->pluck('id');

			if(!$tagId){
				//id makynach donc insret tag apres pivot
				$tagg->name=$value;
				$tagg->save();
				$tagId=$tagg->id;
							

			}
			$post->tags()->attach($tagId);

			
		}


	 return redirect('http://localhost:8080/post/'.$id);

			}

	public function red_update($id)
	{
		$tags=\App\Tag::lists('name','name');
		$post=	\DB::table('posts')
				->where('id','=',$id)
				->get();
		$tags_in= \DB::table('tags')
				->join('post_tag','tags.id','=','post_tag.tag_id')
				->select('tags.name')
				->where('post_tag.post_id','=',$id)
				->lists('name','name');

		return view('Pages.update_post',compact('tags','post','tags_in','id'));	
	// select t.name from tags t , post_tag p where t.id=p.tag_id and p.post_id=85;
	}
}

