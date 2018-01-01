@extends('app')
@section('content')


    <script src="http://localhost:8080/tinymce/js/tinymce/tinymce.min.js"></script> 
    <script src="http://localhost:8080/tinymce/js/tinymce/plugins/compat3x/plugin.min.js"></script>
    <script>
    tinymce.init({
        selector:'#add_post',
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

    


<div class="container-fluid">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading" style='background-image: linear-gradient(125deg, transparent 30%, rgba(166, 200, 31, 0.8)), linear-gradient(45deg, rgb(32, 114, 97), rgb(0, 43, 54)); color: rgb(255, 255, 255); font-size: 20px; font-family: "Roboto-Light";'>Editer votre sujet:</div>
        <div class="panel-body">




      {!! Form::open(['url' => '/post/edit/'.$id ]) !!}
           <div class="from-group" style='margin-bottom:10px;'>
           
               <input type="text" name="title" class="form-control" value="{{ $post[0]->title}}">
           </div>
                      <div>
          
               <textarea id="add_post" name="content" placeholder='Votre contenu ici...'>{{ $post[0]->content}}</textarea>
           </div>
           <div class="from-group">
                {!! Form::label('tag_list' ,'Tags') !!}

                {!! Form::select('tag_list[]',$tags,$tags_in,['id' => 'tag_list','class' => 'form-control','multiple'])!!}
           </div>
           <div class="from-group">
                {!! Form::submit('éditer',['class' => 'btn'])!!}
           </div>
       {!! Form::close() !!}

       </div>
       </div>
       </div>
       </div>
       </div>

    <script src="http://localhost:8080/js/select2.min.js"></script>      

    <script type="text/javascript">
       $('#tag_list').select2({
           placeholder: 'tags', 
           tags:true ,
           tokenSeparators: [',', ' ']
    
        });
     </script>
@endsection