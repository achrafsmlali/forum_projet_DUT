
<!DOCTYPE html>

<html>
<head>
	<meta charset="UTF-8" />
	<title>TinyMCE QUnit tests</title>
	
</head>
<body>
		<script src="http://localhost:8080/tinymce/js/tinymce/tinymce.min.js"></script> 
		<script src="http://localhost:8080/tinymce/js/tinymce/plugins/compat3x/plugin.min.js"></script>
	    <script>
        tinymce.init({
        	selector:'textarea',
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
	<textarea>Your content here</textarea>

</body>

<body>



</body>
</html>
