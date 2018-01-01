
	<script src="http://localhost:8080/tinymce/js/tinymce/tinymce.min.js"></script> 
	<script src="http://localhost:8080/tinymce/js/tinymce/plugins/compat3x/plugin.min.js"></script>
    <script>
    tinymce.init({
    	selector:'#add_answer',
		toolbar: 'undo redo | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | codesample | phpimage | code',
    	plugins: "codesample codemirror",
    	menubar: "false",
    	external_plugins:{
		  "phpimage": "http://localhost:8080/tinymce/js/tinymce/plugins/phpimage/editor_plugin.js",
		},
		codemirror: {
	    indentOnInit: true, // Whether or not to indent code on init.
	    path: 'CodeMirror', // Path to CodeMirror distribution
	    config: {           // CodeMirror config object
	       mode: 'application/x-httpd-php',
	       lineNumbers: false
	    },
	    jsFiles: [          // Additional JS files to load
	       		'mode/clike/clike.js',
	       		'mode/php/php.js'
	    	]
	  	},
			relative_urls: false
		});
    </script>

    <script type="text/javascript">
	$(document).ready(function(){

   			$('#post_editor').submit(function(e){
			    e.preventDefault();
				var a_post = $('input[name="a_post"]').val();
				var a_user = $('input[name="a_user"]').val();
				var a_content = tinyMCE.get('add_answer').getContent();
				var _type = $('input[name="a_type"]').val();
				var a_token = $('input[name="a_token"]').val();
				var data = new FormData();
				data.append('a_token',	a_token);
				data.append('a_user',	a_user);
				data.append('a_post',	a_post);
				data.append('a_content',a_content);
				data.append('_type',_type);

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
						tinymce.activeEditor.setContent('');
						$('#fetch_answers').load('http://localhost:8080/post/answers/{{ $post->id }}');
					},
					error: function (request, error) {
						$('#a_error').html('<div class="alert alert-danger" style="margin-bottom: 5px; margin-top: 5px;" role="alert"><strong>Erreur: </strong>Vérfier que vous avez entrer votre reponse correctement. ou <b><a href="#" style="color: rgb(186, 68, 66);" onclick="window.location.reload(true);">actualiser le page</a></b> si cette erreur ce reppetera.</div>');
		    		}
				});
			});
	}); 
	</script>
	<div id="a_error"></div>
	<form id="post_editor" action="http://localhost:8080/post/{{ $post->id }}" method="post" >
		<input type="hidden" name="a_token" id="a_token"  value="{{ csrf_token() }}">
		 @if (!Auth::guest())
			<input type="hidden" name="a_user"  value="{{ Auth::user()->id }}" />
		@endif
		<input type="hidden" name="a_post"  value="{{ $post->id }}" />
		<input type="hidden" name="a_type" value="answer" >
		<textarea id="add_answer" name="a_content" placeholder='Votre contenu ici...'></textarea>
		<input type="submit" value="Valider" style="background: rgb(255, 255, 255) none repeat scroll 0% 0%; margin: 5px; border: 2px solid rgb(85, 26, 139); color: rgb(85, 26, 139); font-weight: bold; padding: 2px 50px;" class="btn">
	</form>
