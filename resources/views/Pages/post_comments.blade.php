	<div class="post_comments">

	<?php if($comments!=0){
		$comments_counter=0;
		?>
		@foreach($post_comments as $comment)
			<div class="pc_comment">
				
				<div>{{ $comment->content }} - 			
					<a href="/profile/{{ $comment->user->id }}" >{{ $comment->user->name }}</a> <small style="font-weight: bold; color: rgb(140, 140, 140);" >{{ $comment->created_at }}</small>	
					@if ( !Auth::guest() && (Auth::user()->profile=="admin"  || Auth::user()->id==$comment->user_id ))
					<a class="delete_comment" data-id="{{ $comment->id }}" ><span class="glyphicon glyphicon-remove" aria-hidden="true"></span> Suprimmer</a>
					@endif	
				</div>
			</div>
			<?php $comments_counter++;?>
		@endforeach
	<?php 	}else{?>
		<div class="alert alert-warning" style="margin-top: 10px;" role="alert">
		  Ce post n'avait aucun commentaire. <a href="#comments_editor" class="alert-link">Soiyez le premier</a>
		</div>
	<?php }?>

	<script type="text/javascript">
		$(document).ready(function(){
				$('.delete_comment').click(function(e){
		if (confirm("Confirme votre action") == true) {
			e.preventDefault();
			var data = new FormData();
			data.append('id',	$(this).attr("data-id"));

			$.ajax({
				type:"POST",
				url:"http://localhost:8080/deletecomment",
				data:data,
				processData: false,
				contentType: false,
				statusCode: {
			        401: function (data) {
			        	window.location.replace("http://localhost:8080/auth/login");
			        }
			    },
				success: function(data){
					$('#comment_display').load('http://localhost:8080/post/comments/{{ $post_id }}');
					$('#fetch_answers').load('http://localhost:8080/post/answers/{{ $post_id }}');
				},
				error: function (request, error) {
					alert(error);
	    		}
			});
		}			
	});
			$('#link1').click(function(e){
				$('#comment_display').load("http://localhost:8080/post/comments/{{ $post_id }}/?page="+$(this).attr("data-link"));
			});
			$('#link2').click(function(e){
				$('#comment_display').load("http://localhost:8080/post/comments/{{ $post_id }}/?page="+$(this).attr("data-link"));
			});
		});
	</script>
	 <?php 
	  if ($comments>10) { ?>
	<nav>
	  <ul class="pager">
	  <?php 
	  if ($post_comments->lastPage()!=1) {
	  	if (($post_comments->currentPage()-1)>=1) {
			$p= $post_comments->currentPage() - 1;
			echo '<li><a href="#comment_display" id="link1" data-link="'.$p.'" > <span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span> </a></li>';
		} else {
			echo '<li class="disabled" ><a href="#comment_display"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a></li>';
		}
		if (($post_comments->currentPage()+1)<=$post_comments->lastPage()) {
			$p= $post_comments->currentPage() + 1;
			echo '<li><a href="#comment_display" id="link2" data-link="'.$p.'" > <span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span> </a></li>';
		} else {
			echo '<li class="disabled" ><a href="#comment_display"><span class="glyphicon glyphicon-menu-right" aria-hidden="true"></span></a></li>';
		}
	  }
		?>
	  </ul>
	</nav>
	<?php } ?>
	</div>



