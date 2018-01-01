@extends('app')

@section('content')

<?php
$now   = time();
 
function dateDiff($date1, $date2){
    $diff = abs($date1 - $date2); 
    $tmp = $diff;
    $retour['second'] = $tmp % 60;
 
    $tmp = floor( ($tmp - $retour['second']) /60 );
    $retour['minute'] = $tmp % 60;
 
    $tmp = floor( ($tmp - $retour['minute'])/60 );
    $retour['hour'] = $tmp % 24;
 
    $tmp = floor( ($tmp - $retour['hour'])  /24 );
    $retour['day'] = $tmp;
 	
    if ($retour['day']>0){
    	return "il y a ".$retour['day']." jours";
    } elseif($retour['hour']>0){
    	return "il y a ".$retour['hour']." heurs";

    } elseif($retour['minute']>0){
    	return "il y a ".$retour['minute']." minutes";
    } else{
    	return "il y a ".$retour['second']." seconds";
    }
}

?>

<div id="posts">
	<div class="media">
	  <div class="media-left">
	    <div class="media-object" >
	      <img  class="img-circle" src="http://localhost:8080/images/cat_icons/PNG/64/{{ $id->image_link}}" width="150px" height="150px">
	    </div>
	  </div>
	  <div class="media-body">
	    <h4 class="media-heading">{{ $cat->nom }}</h4>
	    <p>{{ $cat->description }}</p>
	    <a class="btn" style="margin-left:5px;background: rgb(198, 223, 248) none repeat scroll 0% 0%; float: right;" href="/createpost/{{ $id->nom }}" role="button" >Posez votre question?</a>
	  </div>
	</div>
	<ul style="padding-left: 0px;">

	@foreach($posts as $post )
		<li class="post">
			<div class="panel panel-default" style="margin-right: 0px;">
			  	<div class="panel-body" id="post_inline" style="padding: 10px; min-height: 70px;">
			    	<div class="vote">
			    		<ol style="padding-left: 0px;" >
			    			<li  style="color:#1D591B;" class="likes" >	    	
			    				{{ $post->get_po_vote($post->id) }} <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
			    			</li>
			    			<center><li class="border_bt"></li></center>
			    			<li  style="color:#F54032;" class="likes" >	    	
			    				{{ $post->get_neg_vote($post->id) }}<span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
			    			</li>
			    		</ol>
			    	</div>
			    	<div class="title"><a href="/post/{{ $post->id }}">{{ $post->title }}</a></div>
			    	<div class="infos">{{ $post->views }} views</div>
			    	<div class="pic">
			    		<img src="{{ asset($post->user->image_link) }}" class="img-circle" width="40px" height="40px">
			    	</div>
			    	<div class="user_info">
			    		publie par:<a href="<?php echo "/profile/".$post->user->name;?>">{{ $post->user->name }}</a><br>
			    		<?php echo dateDiff($now, strtotime($post->created_at)); ?>
			    	</div>
				</div>
			</div>
		</li>	
	@endforeach
	</ul>
</div>
<div class="row">
	<div class="col-md-12">{!! $posts->render() !!}</div>
</div>
@endsection
