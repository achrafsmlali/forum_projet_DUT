@extends('app')

@section('content')
<?php 
	$a= strtotime($post->created_at);
	$b= date("F, d Y",$a);
	$d= date("H:i",$a);
?>
<div id="side">
<div class="panel panel-default">
  <div class="panel-heading" style="color: rgb(255, 255, 255); font-family: ops; font-weight: bold; border-bottom: 2px solid rgb(242, 108, 79); background: rgb(81, 115, 144) none repeat scroll 0% 0%;" >à propos</div>
  <div class="panel-body">
    	<ul style="padding-left: 0px; margin-bottom: 0px;">
			<li><b>Vues:</b> {{ $post->views }}</li>
			<li><b>Publier le: </b><?php echo $b; ?></li>
			<li><b>Reponses:</b> {{ $answers }}</li>
			<li><b>Commentaires:</b> {{ $comments }}</li>
		</ul>
  </div>
</div>
			
	<div class="panel panel-default">
  		<div class="panel-heading" style="color: rgb(255, 255, 255); font-family: ops; font-weight: bold; border-bottom: 2px solid rgb(242, 108, 79); background: rgb(81, 115, 144) none repeat scroll 0% 0%;">les postes similaire</div>
  			<div class="list-group">
  				@foreach( $related_posts as $po)
			 		<a href="/post/{{$po->id}}" class="list-group-item">{{ $po->title }}</a>
			  	@endforeach
			</div>
	</div>

	<div class="panel panel-default">
  		<div class="panel-heading" style="color: rgb(255, 255, 255); font-family: ops; font-weight: bold; border-bottom: 2px solid rgb(242, 108, 79); background: rgb(81, 115, 144) none repeat scroll 0% 0%;">les postes similaire</div>
  			<div class="list-group">
  				@foreach( $recents as $po)
			 		<a href="/post/{{$po->id}}" class="list-group-item">{{ $po->title }}</a>
			  	@endforeach
			</div>
	</div>


</div>

<div id="posts" style="margin-left: 16px; margin-right: 0px; padding-right: 10px;" >
	<div class="title" style="width: 100%;">
		<h1 style="text-transform: capitalize;" >{{ $post->title }}</h1>
		<hr style="margin-top: 5px; margin-bottom: 0px;">
	</div>
	<div class="post_content">
		<p>{{ $post->content }}</p>
	</div>
	<div class="post_tags">
		@foreach( $post->tags as $tag )
			<a href="/tag/{{$tag->name}}">{{$tag->name}}</a>
		@endforeach
	</div>
	<br>
	<div class="user_infos">
		<table border="0" style="width: 99%;height:100px;">
			<tr>
				<td class="ui_image" style="width: 70px;" ><img src="{{ asset($post->user->image_link) }}" class="img-circle" width="60px" height="60px"></td>
				<td style="background: rgb(227, 222, 219) none repeat scroll 0% 0%; border-radius: 0px 20px 20px 0px;">
					<ol style="padding: 10px;margin:0px;">
						<li><b><a href="#" style="color: rgb(41, 40, 51);" >{{$post->user->name}}</a></b></li>
						<li>
							Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod<br>
							tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,<br>
							quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						</li>
					</ol>
				</td>
			</tr>

		</table>
	</div>
	
	<h5 style="margin-bottom: 0px;margin-top: 10px;"><b><span class="badge">{{ $comments }}</span> Comments: </b></h5>
	<hr style="margin-top: 5px; margin-bottom: 0px;">
	<div class="post_comments">
	<?php if($comments!=0){?>
		@foreach($post_comments as $comment)
			<div class="pc_comment">
				<?php 
					echo "<div>".$comment->content."</div>";
				
				?>
				
				<div class="pc_user"><a href="/profile/{{ $comment->user->name }}">{{ $comment->user->name }}</a><div style="float:right;"> {{ $comment->created_at }} </div></div>
			</div>
		@endforeach
	<?php 	}else{?>
		<div class="alert alert-warning" role="alert">
		  Ce post n'avait aucun commentaire. <a href="#comments_editor" class="alert-link">Soiyez le premier</a>
		</div>
	<?php }?>

	</div>

	<h5 style="margin-bottom: 0px;margin-top: 10px;"><b><span class="badge">{{ $answers }}</span> Reponses: </b></h5>
	<hr style="margin-top: 5px; margin-bottom: 0px;">
	<div class="post_comments">
	<?php if($answers!=0){?>
		@foreach($post_answers as $answer)
			<div class="pc_comment" style="margin-left: 0px;">
				<?php 
					echo "<div>".$answer->content."</div>";
				?>
				
				<div class="pc_user"><a href="/profile/{{ $answer->user->name }}">{{ $answer->user->name }}</a><div style="float:right;"> {{ $answer->created_at }} </div></div>
			</div>
					<?php 
					echo count($answer->comment);
					foreach ($answer->comments as $com) {
						echo '<div class="pc_comment">';
						echo "<div>".$com->content."</div>";
						echo '<div class="pc_user"><a href="/profile/{{ $com->user->name }}">{{ $com->user->name }}</a><div style="float:right;"> {{ $answer->created_at }} </div></div>
								</div>';
					} ?>
		@endforeach
	<?php 	}else{?>
		<div class="alert alert-warning" role="alert">
		  Ce post n'avait aucun reponse. <a href="#_editor" class="alert-link">Soiyez le premier.</a>
		</div>
	<?php }?>

	</div>
<?php //print_r($recents);?>
</div>
@endsection


<!--
<script type="text/javascript">

	document.forms["inscri"]["username"].addEventListener("focusout", validateForm);

	function validateForm() {
	    var b = document.forms["inscri"]["username"];
	    var x = document.forms["inscri"]["username"].value;
	    if (x == null || x == "") {
	        b.style.border = "1px solid #0000FF";
	    }
	}

</script>
-->

