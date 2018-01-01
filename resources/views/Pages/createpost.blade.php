
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
        <div class="panel-heading" style='background-image: linear-gradient(125deg, transparent 30%, rgba(166, 200, 31, 0.8)), linear-gradient(45deg, rgb(32, 114, 97), rgb(0, 43, 54)); color: rgb(255, 255, 255); font-size: 20px; font-family: "Roboto-Light";'>Crée un nouvel post dans: {{ $nomcatg }}</div>
        <div class="panel-body">
{!! Form::open(['url' => '/createpost/'.$numcatg]) !!}
           <div class="from-group" style='margin-bottom:10px;'>
            <b>Titre:</b>
               <input type="text" class="form-control" name="title" placeholder="Titre de votre sujet..." >
           </div>
           <div>
           <b>Contenu:</b>
               <textarea id="add_post" name="content" placeholder='Votre contenu ici...'></textarea>
           </div>
           <div class="from-group">
                {!! Form::label('tag_list' ,'Tags:') !!}
                {!! Form::select('tag_list[]',$tags,null,['id' => 'tag_list','class' => 'form-control','multiple'])!!}
           </div>
           <div class="from-group">
                {!! Form::submit('submit',['class' => 'btn','style'=>'margin:5px;background: rgb(22, 92, 84) none repeat scroll 0% 0%; color: rgb(255, 255, 255); font-weight: bolder;'])!!}
           </div>
       {!! Form::close() !!}
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
      </div>
    </div>
  </div>
</div>






      
    <script src="http://localhost:8080/js/select2.min.js"></script>      

    <script type="text/javascript">
       $('#tag_list').select2({
           placeholder: 'tags', 
           tags:true ,
           tokenSeparators: [',', ' '],
           maximumSelectionLength: 5
        });
     </script>
@endsection