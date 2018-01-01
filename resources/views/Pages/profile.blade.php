@extends('app')

@section('content')
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Entre Votre Mot de pass</h4>
      </div>
      <div class="modal-body">
        <form method="POST" action="/profile/{{$u}}">
        	<input type="hidden" name="_token" id="a_token"  value="{{ csrf_token() }}">
        	<input type="password" class="form-control" name="password">
        	<center><input type="submit" class="btn" name="submit" value="Confirmé"></center>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid">
<?php 
if (isset($_GET['error'])) {
	echo '<div class="alert alert-danger" role="alert">Le mot de passe que vous avez entre est incorrect</div>';
} ?>
	<div class="media">
	  <div class="media-left">
	    <div class="media-object" >
	      <img  class="img-circle" src="{{ $user->image_link}}" width="150px" height="150px">
	    </div>
	  </div>
	  <div class="media-body">
	    <h4 class="media-heading">{{ $user->name }}</h4>
	    <p>{{ $user->about_me }}</p>
	    <?php if (!Auth::guest() && Auth::user()->id==$u) {
	    	echo '<a class="btn" style="margin-left:5px;background: rgb(198, 223, 248) none repeat scroll 0% 0%; float: right;" href="/edit_profile" role="button">Modifier Votre Profile</a>';
	    	echo '<button type="button" class="btn" data-toggle="modal" data-target="#myModal" style="margin-left:5px;background: rgb(198, 223, 248) none repeat scroll 0% 0%; float: right;" >Suprimmer Votre Compte</button>';
	    } 
	     ?>
	  </div>
	</div>
	<hr>
<h3>Dernier Activite</h3>
	<div>

  <!-- Nav tabs -->
  <ul class="nav nav-tabs" role="tablist">
    <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Sujets</a></li>
    <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Commentaire</a></li>
    <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab">Reponse</a></li>
  </ul>

  <!-- Tab panes -->
  <div class="tab-content">




    <div role="tabpanel" class="tab-pane active" id="home">
    	<?php if ($c_posts==0) {?>
    	<div class="alert alert-warning" style="margin-top:5px;" role="alert">Aucun sujet trouver</div>
    	<?php
    	} else {?>
		@foreach( $posts as $post )
		    <div class="profpost"> <a href="/post/{{$post->id}}">{{$post->title}}</a><br><b>Publier par:</b> {{$post->user->name}} <b>Le:</b> {{$post->created_at}} <br></div>
		@endforeach
    	<?php
    	}
    	 ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="profile">
    	    	<?php if ($c_comments==0) {?>
    	<div class="alert alert-warning" style="margin-top:5px;" role="alert">Aucun commentaire trouver</div>
    	<?php
    	} else {?>
    	@foreach( $comments as $post )
		    <div class="profpost"> <a href="/post/{{$post->post_id}}"><?php echo substr($post->content,0,100).'...'; ?></a><b>Le:</b> {{$post->created_at}} <br></div>
		@endforeach
		    	<?php
    	}
    	 ?>
    </div>
    <div role="tabpanel" class="tab-pane" id="messages">
        <?php if ($c_answers==0) {?>
    	<div class="alert alert-warning" style="margin-top:5px;" role="alert">Aucun commentaire trouver</div>
    	<?php
    	} else {?>
    	@foreach( $answers as $post )
		    <div class="profpost"> <a href="/post/{{$post->post_id}}"><?php echo substr($post->content,0,100).'...'; ?></a><b>Le:</b> {{$post->created_at}} <br></div>
		@endforeach
		<?php
    	}
    	 ?>
    </div>
  </div>

</div>

</div>




@endsection