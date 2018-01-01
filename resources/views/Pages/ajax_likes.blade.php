<script type="text/javascript">

	$.ajaxSetup({
	headers: {
	  	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
	});


$(document).ready(function(){
	$('#true').hide();
	$('#false2').hide();
	$('#toto1').hide();
	$('#toto2').hide();
	//pour sujet vote up
	$('#post_up').submit(function(e){
	    e.preventDefault();
		var _post = $('#_post').val();
		var _user = $('#_user').val();
		var _token = $('input[name="_token"]').val();
		var data = new FormData();
		data.append('_token',_token);
		data.append('_user',_user);
		data.append('_post',_post);

		$.ajax({
			type:"POST",
			url:"http://localhost:8080/post_up",
			data:data,
			processData: false,
			contentType: false,
			success: function(data){
				if (data==='false') {
					window.location.replace("http://localhost:8080/auth/login");
				}
				else if(data==='false2'){
					$('#toto2').show();
				}else{
					$('#toto1').show();
				};
			}
		});
	});
	//pour sujet vote down
	$('#post_down').submit(function(e){
	    e.preventDefault();
		var _post = $('#_post').val();
		var _user = $('#_user').val();
		var _token = $('input[name="_token"]').val();
		var data = new FormData();
		data.append('_token',_token);
		data.append('_user',_user);
		data.append('_post',_post);

		$.ajax({
			type:"POST",
			method:"POST",
			url:"http://localhost:8080/post_down",
			data:data,
			processData: false,
			contentType: false,
			success: function(data){
				if (data==='false') {
					window.location.replace("http://localhost:8080/auth/login");
				}
				else if(data==='false2'){
					$('#toto2').show();
				}else{
					$('#toto1').show();
				};
			}
		});
	});

	//pour answer vote up
	<?php for ($i=0; $i < $answers ; $i++) { ?>
		$('#answer_up<?php echo $i ?>').submit(function(e){
	    e.preventDefault();
		var _answer = $('#_answer<?php echo $i ?>').val();
		var _user = $('#_user<?php echo $i ?>').val();
		var _token = $('input[name="_token<?php echo $answer_counter;?>"]').val();
		var data = new FormData();
		data.append('_token',_token);
		data.append('_user',_user);
		data.append('_answer',_answer);

		$.ajax({
			type:"POST",
			method:"POST",
			url:"http://localhost:8080/answer_up",
			data:data,
			processData: false,
			contentType: false,
			success: function(data){
				if (data==='false') {
					window.location.replace("http://localhost:8080/auth/login");
				}
				else if(data==='false2'){
					$('#false2').show();
				}else{
					$('#true').show();
				};
			}
		});
	});
	<?php } ?>

	//pour answer vote down
	<?php for ($i=0; $i < $answers ; $i++) { ?>
		$('#answer_down<?php echo $i ?>').submit(function(e){
	    e.preventDefault();
		var _answer = $('#_answer<?php echo $i ?>').val();
		var _user = $('#_user<?php echo $i ?>').val();
		var _token = $('input[name="_token<?php echo $answer_counter;?>"]').val();
		var data = new FormData();
		data.append('_token',_token);
		data.append('_user',_user);
		data.append('_answer',_answer);

		$.ajax({
			type:"POST",
			method:"POST",
			url:"http://localhost:8080/answer_down",
			data:data,
			processData: false,
			contentType: false,
			success: function(data){
				if (data==='false') {
					window.location.replace("http://localhost:8080/auth/login");
				}
				else if(data==='false2'){
					$('#false2').show();
				}else{
					$('#true').show();
				};
			}
		});
	});
	<?php } ?>

});


</script>
