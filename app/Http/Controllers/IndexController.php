<?php namespace App\Http\Controllers;

use App\User;
use App\Post;
use Request;

class IndexController extends Controller {

	public function index()
	{	
		$posts = Post::paginate(20);
		return view('posts',compact('posts'));
	}
	public function home()
	{	
		$lastposts=\DB::table('posts')
            ->whereIn('id',function ($query) {
                $query->select('id')
		                ->from('posts')
		                ->groupBy('catg_id')
		                ->havingRaw('MAX(id)');
            })
            ->orderBy('catg_id', 'asc')
            ->get();
		$catg = \DB::table('posts')
				->select('catg_id','title')
                ->groupBy('catg_id')
                ->havingRaw('MAX(id)')
                ->get();

		$categories = \App\Categorie::paginate(50);
		return view('Pages.index_page',compact('categories','lastposts'));
	}

	public function aboutus()
	{
		return view('Pages.aboutus');
	}
	public function showprofile($id)
	{
		$u=$id;
		$user  = \App\User::find($id);
		$posts = \App\Post::where("user_id","=",$id)->get();
		$comments = \App\Comment::where("user_id","=",$id)->get();
		$answers = \App\Answer::where("user_id","=",$id)->get();
		$c_posts = \App\Post::where("user_id","=",$id)->count();
		$c_comments = \App\Comment::where("user_id","=",$id)->count();
		$c_answers = \App\Answer::where("user_id","=",$id)->count();


		return view('Pages.profile',compact('u','user','posts','comments','answers','c_posts','c_comments','c_answers'));
	}

	public function deleteaccount($id,Request $request)
	{
		$user  = \App\User::find($id);
		if (password_verify(Request::get('password'),$user->password)) {
			User::destroy($id);
			return redirect('http://localhost:8080/auth/logout');
		} else {
			return redirect('http://localhost:8080/profile/'.$id.'?error=1');
		}
		
	}
}

