<?php namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Http\Request;

class IndexController extends Controller {


	public function index()
	{	
		$posts = Post::paginate(20);
		return view('posts',compact('posts'));
	}

	
}

