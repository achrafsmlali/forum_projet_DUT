<a href="http://localhost:8080/createpost/{{$post->catg_id}}" style="color:#FFF;" class="askyour" >
<div  style="" >
	Posez votre question
</div>
</a>

<div class="panel panel-default">
  <div class="panel-heading" style="color: rgb(255, 255, 255); font-family: ops; font-weight: bold; background: linear-gradient(125deg, transparent 30%, rgba(166, 200, 31, 0.8)) repeat scroll 0% 0%, transparent linear-gradient(45deg, rgb(32, 114, 97), rgb(0, 43, 54)) repeat scroll 0% 0%;"  >à propos</div>
  <div class="panel-body">
    	<ul style="padding-left: 0px; margin-bottom: 0px;">
			<li><b>Publier le: </b><?php echo $b; ?></li>
			<li><b>Vues:</b> {{ $post->views }}</li>
			<li><b>Reponses:</b> {{ $answers }}</li>
			<li><b>Commentaires:</b> {{ $comments }}</li>
		</ul>
  </div>
</div>
			
	<div class="panel panel-default">
  		<div class="panel-heading" style="color: rgb(255, 255, 255); font-family: ops; font-weight: bold; background: linear-gradient(125deg, transparent 30%, rgba(166, 200, 31, 0.8)) repeat scroll 0% 0%, transparent linear-gradient(45deg, rgb(32, 114, 97), rgb(0, 43, 54)) repeat scroll 0% 0%;" >les postes similaire</div>
  			<div class="list-group">
  				@foreach( $related_posts as $po)
			 		<a href="/post/{{$po->id}}" class="list-group-item">{{ $po->title }}</a>
			  	@endforeach
			</div>
	</div>

	<div class="panel panel-default">
  		<div class="panel-heading" style="color: rgb(255, 255, 255); font-family: ops; font-weight: bold; background: linear-gradient(125deg, transparent 30%, rgba(166, 200, 31, 0.8)) repeat scroll 0% 0%, transparent linear-gradient(45deg, rgb(32, 114, 97), rgb(0, 43, 54)) repeat scroll 0% 0%;" >les postes recents</div>
  			<div class="list-group">
  				@foreach( $recents as $po)
			 		<a href="/post/{{$po->id}}" class="list-group-item"><?php echo (strlen($po->title)<=90) ? $po->title : substr( $po->title ,0,87)."..." ?></a>
			  	@endforeach
			</div>
	</div>
