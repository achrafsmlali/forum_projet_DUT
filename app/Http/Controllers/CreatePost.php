<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class CreatePost extends Controller {

	public function create($id,Request $request)
	{
			$post = new \App\Post;
			$title = $request->input('title');
			$content = $request->input('content');
			$post->content =$content;
			$post->title =$title;
			$post->user_id =Auth::user()->id;
			$post->catg_id =$id;
			$post->save();

		foreach ($request->input('tag_list') as $value) {
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

			return redirect('http://localhost:8080/post/'.$post->id);
	}


	public function taging($id){
		$tags=\App\Tag::lists('name','name');
		$categorie = \App\Categorie::find($id);
		$nomcatg = $categorie->nom;
		$numcatg=$id;
		return view('Pages.createpost',compact('tags','nomcatg','numcatg'));
	}

	

}
