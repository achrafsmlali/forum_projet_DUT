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


<div id="shposts">
	<ul style="padding-left: 0px;">
	@if(count($posts)!=0)
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
			    		publie par:<a href="<?php echo "/profile/".$post->user->id;?>">{{ $post->user->name }}</a><br>
			    		<?php echo dateDiff($now, strtotime($post->created_at)); ?>
			    	</div>
				</div>
			</div>
		</li>	
	@endforeach
	@else
	<br>
	<br>
	<br>
	<br>
	<div class="alert alert-warning" role="alert">
	  Aucun resultat n'etait trouve.
	</div>
		<br>
	<br>
	<br>
	<br>
	@endif
	</ul>
</div>
<div class="row">
	<div class="col-md-12">{!! $posts->render() !!}</div>
</div>



@endsection
