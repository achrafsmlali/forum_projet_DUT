<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/bt/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/bt/css/custom.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/bt/css/styles.css') }}">
	<link rel="stylesheet" type="text/css" href="http://localhost:8080/tinymce/js/tinymce/plugins/codesample/css/prism.css">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link href="http://localhost:8080/css/select2.min.css" rel="stylesheet" />
    <script src="http://localhost:8080/tinymce/js/tinymce/plugins/codesample/classes/Prism.js"></script>
</head>
<body>
<script type="text/javascript" src="http://localhost:8080/js/jquery-2.2.1.js"></script>
<script type="text/javascript" src="http://localhost:8080/bt/js/bootstrap.min.js"></script>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="http://localhost:8080/">NovaDev</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      	<ul class="nav navbar-nav">
        	<li><a href="#"></a></li>
      	</ul>

      	<ul class="nav navbar-nav navbar-right">
			@if (Auth::guest())
				<li role="presentation" ><a href="{{ url('/auth/login') }}">Connectez-Vous</a></li>
				<li role="presentation" ><a href="{{ url('/auth/register') }}">Inscrivez-Vous</a></li>
			@else
				<li><a href="<?php echo "/profile/".Auth::user()->id;?>">{{ Auth::user()->name }}</a></li>
				<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
			@endif      
			    <li>
			      	<form class="navbar-form navbar-left" role="search" action="/search" method="get" >
				        <div class="form-group">
				          <input type="text" class="form-control" name="search" style="color: #fff;border: 0px none;background: rgba(40, 73, 7, 0.55) none repeat scroll 0% 0%;" placeholder="Recherche....">
				        </div>
				        <button type="submit" class="btn navbtn" style="" >Rechercher</button>
				    </form>
		      	</li>
		</ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>


<div class="content" > 
	@yield('content')
</div>

<div class="footter">
	<div class="page-header" style="border-bottom: 0px solid rgb(238, 238, 238);">
	  <center>
	  	<h3><strong>Nova Dev:</strong>Développé pour vous, pour résoudre vos problèmes.</h3>
	  </center>
	</div>
	<ul class="list-inline" style="width:500px;margin:auto;">
		<li>
			<section>
				<h5 style="border-bottom:1px #fff solid;">Nova Dev</h5>
				<ul id="foot1">
					<li><a href="http://localhost:8080/aboutus">Qui nous sommes</a></li>
					<li><a href="#">Contacter nous</a></li>
					<li><a href="#">Termes et conditions</a></li>
				</ul>
			</section>
		</li>
		<li style="vertical-align: top;margin-left:30px;">
			<section>
				<h5 style="border-bottom:1px #fff solid;">Suivez Nous</h5>
				<ul class="list-inline" style="padding-left: 0px; list-style: outside none none;" >
					<li><a href="#" style="color: rgb(255, 255, 255);" ><img class="over"  src="http://localhost:8080/images/f.png" width="32px" ></a></li>
					<li><a href="#" style="color: rgb(255, 255, 255);" ><img class="over"  src="http://localhost:8080/images/g.png" width="32px" ></a></li>
					<li><a href="#" style="color: rgb(255, 255, 255);" ><img class="over"  src="http://localhost:8080/images/t.png" width="32px" ></a></li>
					<li><a href="#" style="color: rgb(255, 255, 255);" ><img class="over"  src="http://localhost:8080/images/i.png" width="32px" ></a></li>
				</ul>
			</section>
		</li>
	</ul>
	<div style="margin-top:10px;margin-left: 100px; margin-right: 100px;text-align:center;" >PFE Forum Informatique Réalisé 2015-2016 Par: Z.SALAH-EDDINE et A.SMLALI</div>
</div>

</body>
</html>

