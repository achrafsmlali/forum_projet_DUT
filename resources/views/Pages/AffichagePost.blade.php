@extends('app')

@section('content')



<?php 
	$a= strtotime($post->created_at);
	$b= date("F, d Y",$a);
	$d= date("H:i",$a);
?>

<div id="side">

@include('Pages.posts_side')

</div>

<div id="errors_"></div>
<div id="posts" style="margin-left: 16px; margin-right: 0px; padding-right: 10px;" >
	<div class="title" style="width: 100%;">
		<div id="toto1" class="alert alert-success" role="alert">
		  <strong>Votre vote est bien enregistre.</strong>
		</div>
		<div id="toto2" class="alert alert-danger" role="alert">
		  <strong>Vous avez déja voter pour ce sujet.</strong>
		</div>
		<h1 style="text-transform: capitalize;" >{{ $post->title }}</h1>
		<hr style="margin-top: 5px; margin-bottom: 0px; border-radius: 20px; border: 1px solid rgb(220, 224, 215);" >
		<ul class="list-inline" style="font-size: 13px; margin-top: 5px;color: rgb(80, 80, 80);">
			<li><span class="glyphicon glyphicon-eye-open" aria-hidden="true" style="font-size: 11px;"></span><b> Vues:</b> {{ $post->views }}</li>
			<li><span class="glyphicon glyphicon-time" aria-hidden="true"></span><b> Publier le: </b><?php echo $b; ?></li>
			<li>
				<form id="post_up" action="#">
					<input type="hidden" name="_token" id="_token"  value="{{ csrf_token() }}">
					<input type="hidden" name="_post" id="_post"  value="{{ $post->id }}" />
					@if (!Auth::guest())
					<input type="hidden" name="_user" id="_user"  value="{{ Auth::user()->id }}" />
					@else
					<input type="hidden" name="_user" id="_user"  value="null" />
					@endif
					<button type="submit" class="btn btn-default btn-xs" aria-label="Left Align" style="color: rgb(80, 80, 80);">
		  				<b>J'aime {{ $_up }} </b><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
					</button>
				</form>
			</li>
			<li>
				<form id="post_down" action="#">
					<input type="hidden" name="_token" id="_token"  value="{{ csrf_token() }}">
					<input type="hidden" name="_post" id="_post"  value="{{ $post->id }}" />
					@if (!Auth::guest())
					<input type="hidden" name="_user" id="_user"  value="{{ Auth::user()->id }}" />
					@else
					<input type="hidden" name="_user" id="_user"  value="null" />
					@endif
					<button type="submit" class="btn btn-default btn-xs" aria-label="Left Align" style="color: rgb(80, 80, 80);">
		  				<b>{{ $_down }} </b><span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
					</button>
				</form>
			</li>
			@if ( !Auth::guest() && ( Auth::user()->profile=="admin" || Auth::user()->id==$post->user_id ))
			<li><a data-id="{{ $post->id }}" class="delete_post" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Suprimmer</a></li>
			@endif
			<li class="modifie_post" style="margin-right:5px;float:right">
				
				@if( !Auth::guest() && Auth::user()->id == $post->user_id)
  					<a href="/post/edit/{{$post->id}}"><span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
				@endif
				
			</li>
		</ul>
	</div>
	<div class="post_content">
		<p><?php echo $post->content  ?></p>
	</div>
	<div class="post_tags">
		<strong>Tags: </strong>
		@foreach( $post->tags as $tag )
			<a href="/tag/{{$tag->name}}">{{$tag->name}}</a>
		@endforeach
	</div>
	<br>
	<div class="user_infos">
		<ul class="list-inline" style="margin: 0px;">
			<li>
				<img class="img-circle" src="{{ $post->user->image_link }}" width="60px" height="60px">
			</li>
			<li style="vertical-align: middle; width: 90%;">
				<ol style="padding:0px;">
					<li><b><a href="#" style="color: rgb(41, 40, 51);" ></a></b></li>
					<li>
						<span style="color:#354242;" >Par:</span> {{ $post->user->name }} <br>
						<span style="color:#354242;" >A-propos:</span> {{ $post->user->about_me }} <br>
						<span style="color:#354242;" >Membre depuis:</span><?php echo substr($post->user->created_at, 0,10) ?>
					</li>
				</ol>
			</li>
		</ul>

	</div>
	<script type="text/javascript">
			$(document).ready(function(){

	$('.delete_post').click(function(e){
			if (confirm("Confirme votre action") == true) {
				e.preventDefault();
				var data = new FormData();
				data.append('id',	$(this).attr("data-id"));

				$.ajax({
					type:"POST",
					url:"http://localhost:8080/deletepost",
					data:data,
					processData: false,
					contentType: false,
					statusCode: {
				        401: function (data) {
				        	window.location.replace("http://localhost:8080/auth/login");
				        }
				    },
					success: function(data){
						window.location.replace('http://localhost:8080/');
					},
					error: function (request, error) {
						alert(error);
		    		}
				});
		    }
			
		});
});
	</script>
	<h5 style="margin-bottom: 0px;margin-top: 10px; font-family: 'Roboto-Light';"><b><span class="badge">{{ $comments }}</span> Comments: </b></h5>
	<hr style="margin-top: 5px; margin-bottom: 0px;">
	<div id="comment_display"></div>
	<a href="#add_comment" style="color: rgb(85, 26, 139);font-weight: bold; float: right; margin-right: 100px; font-size: 11px;" onclick="Comment()"><span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Ajouter votre commentaire.</a><br>
	<script type="text/javascript">
	$(document).ready(function(){

		$('#comment_display').load('http://localhost:8080/post/comments/{{ $post->id }}');
   		$('#add_comment').hide();
   			$('#add_comment_form').submit(function(e){
			    e.preventDefault();
				var c_post 		= $('input[name="c_post"]').val();
				var c_user 		= $('input[name="_user"]').val();
				var c_content 	= $('textarea[name="c_content"]').val();
				var _type 		= $('input[name="_type"]').val();
				var c_token 	= $('input[name="c_token"]').val();
				var c_answer 	= $('input[name="c_answer"]').val();
				var c_relative 	= $('input[name="c_relative"]').val();

				var data = new FormData();
				data.append('c_token',	c_token);
				data.append('c_user',	c_user);
				data.append('c_post',	c_post);
				data.append('c_content',c_content);
				data.append('c_answer',c_answer);
				data.append('c_relative',c_relative);
				data.append('_type',	_type);

				$.ajax({
					type:"POST",
					url:"http://localhost:8080/post/{{ $post->id }}",
					data:data,
					processData: false,
					contentType: false,
					statusCode: {
				        401: function (data) {
				        	window.location.replace("http://localhost:8080/auth/login");
				        }
				    },
					success: function(data){
						$('#add_comment').hide();
						if (data=="answer") {
							$('#fetch_answers').load('http://localhost:8080/post/answers/{{ $post->id }}');
						} else{
							$('#comment_display').load('http://localhost:8080/post/comments/{{ $post->id }}');
						};
					},
					error: function (request, error) {
						$('#c_error').html('<div class="alert alert-danger" style="margin-left: 100px; margin-bottom: 5px; margin-top: 5px;" role="alert"><strong>Erreur: </strong>Verfier que vous avez entrer votre commentaire correctement. ou <b><a href="#" style="color: rgb(186, 68, 66);" onclick="window.location.reload(true);">actualiser le page</a></b> si cette erreur ce reppetera.</div>');
		    		}
				});
			});
	}); 
	function Comment()
	{
	    $('#add_comment').show();
	    $('#c_area').attr("placeholder","Vous etes entrain de commeter sur se sujet...");
	    $('input[name="c_answer"]').val("null");
	    $('input[name="c_relative"]').val("1");
	}
	
	</script>

	<div id="c_error"></div>
	<div id="add_comment" style="margin-left: 100px;">
	
		<form id="add_comment_form" action="http://localhost:8080/post/{{ $post->id }}" method="post" >
			<textarea style="width: 99%;padding:4px;"rows="3" class="form-control" name="c_content" id="c_area" placeholder='Votre contenu ici...'></textarea>
			<input type="hidden" name="c_token" id="_token"  value="{{ csrf_token() }}">
			@if (!Auth::guest()) <input type="hidden" name="c_user"  value="{{ Auth::user()->id }}" /> @endif
			<input type="hidden" name="c_post"  value="{{ $post->id }}" />
			<input type="hidden" name="c_answer"  value="null" />
			<input type="hidden" name="c_relative"  value="1" />
			<input type="hidden" name="_type"  value="comment" />
			<input type="submit" id="comment-btn" value="Commenter" class="btn">
		</form>
	</div>
	<h5 style="margin-bottom: 0px;margin-top: 10px; font-family: 'Roboto-Light';"><b><span class="badge">{{ $answers }}</span> Reponses: </b></h5>
	<hr style="margin-top: 5px; margin-bottom: 15px;">
	<div id="true" class="alert alert-success" role="alert">
	  <strong>Votre vote est bien enregistre.</strong>
	</div>
	<div id="false2" class="alert alert-danger" role="alert">
	  <strong>Vous avez déja voter pour ce sujet.</strong>
	</div>

	<div id="fetch_answers">
	<script type="text/javascript">
	$(document).ready(function(){

		$('.linkReply').click(function(e){
			e.preventDefault();
			$('#add_comment').show();
		    $('#c_area').attr("placeholder","Vous étes entrain répliquer le commentaire de @"+$(this).attr("data-username"));
		    $('input[name="c_answer"]').val($(this).attr("data-id"));
		    $('input[name="c_relative"]').val("0");
		});

		$('.best').click(function(e){
			e.preventDefault();
				var data = new FormData();
				data.append('id',	$(this).attr("data-id"));

				$.ajax({
					type:"POST",
					url:"http://localhost:8080/solution",
					data:data,
					processData: false,
					contentType: false,
					statusCode: {
				        401: function (data) {
				        	window.location.replace("http://localhost:8080/auth/login");
				        }
				    },
					success: function(data){
						$('.notf').html('<div class="alert alert-warning" role="alert">'+data[1]+'</div>');
						$('#fetch_answers').load('http://localhost:8080/post/answers/{{ $post->id }}');
					},
					error: function (request, error) {
						$('.notf').html('<div class="alert alert-danger" style="margin-left: 100px; margin-bottom: 5px; margin-top: 5px;" role="alert">Un erreur non reconu essayer <b><a href="#" style="color: rgb(186, 68, 66);" onclick="window.location.reload(true);">d\'actualiser le page</a></b> si cette erreur ce reppetera.</div>');
		    		}
				});
		});
		$('.delete_answer').click(function(e){
			if (confirm("Confirme votre action") == true) {
				e.preventDefault();
				var data = new FormData();
				data.append('id',	$(this).attr("data-id"));

				$.ajax({
					type:"POST",
					url:"http://localhost:8080/deleteanswer",
					data:data,
					processData: false,
					contentType: false,
					statusCode: {
				        401: function (data) {
				        	window.location.replace("http://localhost:8080/auth/login");
				        }
				    },
					success: function(data){
						$('#fetch_answers').load('http://localhost:8080/post/answers/{{ $post->id }}');
					},
					error: function (request, error) {
						alert(error);
		    		}
				});
		    }
			
		});

	});
	</script>
	<div class="notf"></div>
	<div class="post_comments">
	<?php if($answers!=0){
		$answer_counter=0;
		?>
		@foreach($post_answers as $answer)
			<div class="pc_comment" style="margin-left: 0px;">
							<?php 
					echo "<div style='margin-bottom: 10px;' >".$answer->content."</div>";
				?>
				<div class="panel panel-default" style="margin-left: 0px; margin-right: 0px; margin-bottom: 0px; height: 52px; border-bottom: 2px solid rgba(28, 107, 92, 0.67);">
  					<div class="panel-body" style="padding: 5px;">
  					<img src="{{ $answer->user->image_link }}"class="img-circle" width="40px" height="40px">
				    <a href="/profile/{{ $answer->user->id }}"><strong style="color: rgb(54, 61, 62);" >{{ $answer->user->name }}</strong></a> - <small style="font-weight: bold; color: rgb(140, 140, 140);" ><span class="glyphicon glyphicon-time" aria-hidden="true"></span> {{ $answer->created_at }}</small>
					<div style="float:right;">
						<ul class="list-inline" style="margin-bottom: 0px; margin-top: 9px;">
							@if ( !Auth::guest() && ( Auth::user()->profile=="admin" || Auth::user()->id==$answer->user_id ))
							<li><a data-id="{{ $answer->id }}" class="delete_answer" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Suprimmer</a></li>
							@endif

							@if ( !Auth::guest() && Auth::user()->id==$post->user_id )
							@if ( $answer->best==1 )
							<li><a class="best" id="thebest"  style="color: rgb(28, 107, 92);" data-id="{{ $answer->id }}" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Resolution </a></li>
							@else
							<li><a class="best" id="thebest" style="color: rgb(28, 107, 92);" data-id="{{ $answer->id }}" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></li>
							@endif
							@endif
							<li><a class="linkReply"  style="color: rgb(28, 107, 92);" href="#add_comment_form" data-id="{{ $answer->id }}" data-username="{{ $answer->user->name }}" ><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Répliquer</a></li>
  							<li>
  								<form id="answer_up<?php echo $answer_counter;?>" action="#">
									<input type="hidden" name="_token<?php echo $answer_counter;?>" id="_token<?php echo $answer_counter;?>"  value="{{ csrf_token() }}">
									<input type="hidden" name="_answer<?php echo $answer_counter;?>" id="_answer<?php echo $answer_counter;?>"  value="{{ $answer->id }}" />
									@if (!Auth::guest())
									<input type="hidden" name="_user<?php echo $answer_counter;?>" id="_user<?php echo $answer_counter;?>"  value="{{ Auth::user()->id }}" />
									@else
									<input type="hidden" name="_user<?php echo $answer_counter;?>" id="_user<?php echo $answer_counter;?>"  value="null" />
									@endif
									<button type="submit" class="btn btn-default btn-xs" aria-label="Left Align">
						  				<strong>J'aime {{ $a_up[$answer->id] }} </strong> <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
									</button>
								</form>
  							</li>
  							<li>
	  							<form id="answer_down<?php echo $answer_counter;?>" action="#">
									<input type="hidden" name="_token<?php echo $answer_counter;?>" id="_token<?php echo $answer_counter;?>"  value="{{ csrf_token() }}">
									<input type="hidden" name="_answer<?php echo $answer_counter;?>" id="_answer<?php echo $answer_counter;?>"  value="{{ $answer->id }}" />
									@if (!Auth::guest())
									<input type="hidden" name="_user<?php echo $answer_counter;?>" id="_user<?php echo $answer_counter;?>"  value="{{ Auth::user()->id }}" />
									@else
									<input type="hidden" name="_user<?php echo $answer_counter;?>" id="_user<?php echo $answer_counter;?>"  value="null" />
									@endif
									<button type="submit" class="btn btn-default  btn-xs" aria-label="Left Align">
						  				<b>{{ $a_down[$answer->id] }}</b> <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
									</button>
								</form>			
							</li>
						</ul>				
					</div>
				</div>
				  </div>
				</div>
				<?php $answer_counter++;?>
			
					@foreach ($answer->comments as $com)
						<div class="pc_comment">
							<div>{{ $com->content }} - 			
								<a href="/profile/{{ $com->user->id }}" >{{ $com->user->name }}</a> <small style="font-weight: bold; color: rgb(140, 140, 140);" >{{ $com->created_at }}</small>
								@if ( !Auth::guest() && ( Auth::user()->profile=="admin"  ||  Auth::user()->id==$com->user_id ) )
								<a class="delete_comment" data-id="{{ $com->id }}" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Suprimmer</a>
								@endif
							</div>
						</div>
					@endforeach
		@endforeach
	<script type="text/javascript">
		$(document).ready(function(){
			$('#link3').click(function(e){
				$('#fetch_answers').load("http://localhost:8080/post/answers/{{ $post->id }}/?page="+$(this).attr("data-link"));
			});
			$('#link4').click(function(e){
				$('#fetch_answers').load("http://localhost:8080/post/answers/{{ $post->id }}/?page="+$(this).attr("data-link"));
			});
		});
	</script>
	<nav>
	  <ul class="pager">
	  	<?php 
		  if ($post_answers->lastPage()!=1) {
		  	if (($post_answers->currentPage()-1)>=1) {
				$p= $post_answers->currentPage() - 1;
				echo '<li><a id="link3" data-link="'.$p.'" > <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> </a></li>';
			} else {
				echo '<li class="disabled" ><a href="#comment_display"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a></li>';
			}
			if (($post_answers->currentPage()+1)<=$post_answers->lastPage()) {
				$p= $post_answers->currentPage() + 1;
				echo '<li><a  id="link4" data-link="'.$p.'" > <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> </a></li>';
			} else {
				echo '<li class="disabled" ><a href="#comment_display"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></li>';
			}
		  }
		?>
	  </ul>
	</nav>
	<?php 	}else{?>
		<div class="alert alert-warning" role="alert">
		  Ce post n'avait aucun reponse. <a href="#_editor" class="alert-link">Soiyez le premier.</a>
		</div>
	<?php }

	?>
</div>

@include('Pages.ajax_likes')
</div>



@include('Pages.post_form', ['post_id' => $post->id ])
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-56e091028284cf12"></script>
<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">
  <div class="panel panel-default" style="border-color: rgb(189, 180, 143);" >
    <div class="panel-heading" style="background: rgb(252, 248, 227) none repeat scroll 0% 0%;" role="tab" id="headingThree">
      <h4 class="panel-title">
        <a class="collapsed" role="button" data-toggle="collapse" data-parent="#accordion" href="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
      		Comment utiliser l'editeur: 
        </a>
      </h4>
    </div>
    <div id="collapseThree" class="panel-collapse collapse" role="tabpanel" aria-labelledby="headingThree">
      <div class="panel-body">
      	<p>TinyMC
TinyMC
en logici
d'autres
système
Joomla,
E l’éditeur
E de Moxiec
el Open Sou
éléments H
s de gestion
Drupal, Plon
WYSIWYG
ode est un
rce sous lice
TML en édit
de contenu
e, WordPres
outil JavaSc
nce LGPL.
eur de texte
. TinyMCE
s, b2evoluti
ript / HTML W
Il a la capac
. TinyMCE
est utilisé av
on, E107 et
YSIWYG (
ité de conve
est conçu p
ec de nomb
phpWebSite
What You S
rtir les cham
our s'intégre
reux systèm
.
ee Is What Y
ps textarea
r facilement
es tels que
ou Get),
HTML ou
à divers
Mambo et il contient:</p>
      	<ul>
      		<li>• Editeur de code source</li>
      		<li>• Structure du text</li>
      		<li>• Un outile d'ajoute d'image et mise en forme</li>
      		<li>• Affiche le code source HTML du text</li>
      		<li>...</li>
      	</ul>
      </div>
    </div>
  </div>
</div>
</div>


@endsection

