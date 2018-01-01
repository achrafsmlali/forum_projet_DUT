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
						$('#fetch_answers').load('http://localhost:8080/post/answers/{{ $blolo }}');
					},
					error: function (request, error) {
						$('#c_error').html('<div class="alert alert-danger" style="margin-left: 100px; margin-bottom: 5px; margin-top: 5px;" role="alert">Un erreur non reconu essayer <b><a href="#" style="color: rgb(186, 68, 66);" onclick="window.location.reload(true);">d\'actualiser le page</a></b> si cette erreur ce reppetera.</div>');
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
					$('#fetch_answers').load('http://localhost:8080/post/answers/{{ $blolo }}');
				},
				error: function (request, error) {
					alert(error);
	    		}
			});
		}			
	});

});
	</script>
<div class="post_comments">
	<?php if($answers!=0){
		$answer_counter=0;
		$post_id='';
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
							@if ( !Auth::guest() && ( Auth::user()->profile=="admin"  || Auth::user()->id==$answer->user_id ))
							<li><a data-id="{{ $answer->id }}" class="delete_answer" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Suprimmer</a></li>
							@endif
							@if ( !Auth::guest() && Auth::user()->id == $user_id)
							@if ( $answer->best==1 )
							<li><a class="best" id="thebest"  style="color: rgb(28, 107, 92);" data-id="{{ $answer->id }}" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span> Resolution </a></li>
							@else
							<li><a class="best" id="thebest" style="color: rgb(28, 107, 92);" data-id="{{ $answer->id }}" ><span class="glyphicon glyphicon-ok" aria-hidden="true"></span></a></li>
							@endif
							@endif
							<li><a class="linkReply" style="color: rgb(28, 107, 92);" href="#add_comment_form" data-id="{{ $answer->id }}" data-username="{{ $answer->user->name }}" ><span class="glyphicon glyphicon-share-alt" aria-hidden="true"></span> Répliquer</a></li>
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
						  				<strong>J'aime {{ $a_up[$answer->id] }}</strong> <span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span>
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
						  				<strong>{{ $a_down[$answer->id] }}</strong> <span class="glyphicon glyphicon-thumbs-down" aria-hidden="true"></span>
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
								@if ( !Auth::guest() && ( Auth::user()->profile=="admin" || Auth::user()->id==$com->user_id))
								<a class="delete_comment" data-id="{{ $com->id }}" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Suprimmer</a>
								@endif
							</div>
						</div>
					@endforeach
					<?php $post_id=$answer->post_id; ?> 
		@endforeach
			<script type="text/javascript">
		$(document).ready(function(){
			$('#link3').click(function(e){
				$('#fetch_answers').load("http://localhost:8080/post/answers/{{ $post_id }}/?page="+$(this).attr("data-link"));
			});
			$('#link4').click(function(e){
				$('#fetch_answers').load("http://localhost:8080/post/answers/{{ $post_id }}/?page="+$(this).attr("data-link"));
			});
		});
	</script>
	<?php 
		  if ($answers>10) {?>
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
	<?php 	}
	}else{?>
		<div class="alert alert-warning" role="alert">
		  Ce post n'avait aucun reponse. <a href="#_editor" class="alert-link">Soiyez le premier.</a>
		</div>
	<?php }?>
</div>

@include('Pages.ajax_likes')


