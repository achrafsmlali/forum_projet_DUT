<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="{{ asset('/bt/css/home.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/bt/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/bt/css/custom_1.css') }}">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
	<script type="text/javascript" src="http://localhost:8080/bt/js/jquery.min.js"></script>
	<script type="text/javascript" src="http://localhost:8080/bt/js/bootstrap.min.js"></script>
	<title>NovaDev: tout ce que vous voulez</title>
</head>

<body>
	<script type="text/javascript">
		var myVar = setInterval(function(){ setColor() }, 3000);
		var things = ['<i class="fa fa-html5"></i> HTML 5','<i class="fa fa-code"></i> Java','<i class="fa fa-linux"></i> Linux','<i class="fa fa-android"></i> Android','<i class="fa fa-magic"></i> Frameworks','<i class="fa fa-paint-brush"></i> Design','<i class="fa fa-cogs"></i> Hardware/Software','<i class="fa fa-database"></i> Base de donnes','<i class="fa fa-user-secret"></i> Ethical Hacks'];

		function setColor() {
			var x = document.getElementById('subtitle');
			var i = Math.round((Math.random()) * things.length);
			if (i == things.length) --i;
			x.innerHTML=things[i];
		}

	</script>
    <div class="lara">
		<div  style="height:100%;display:flex;justify-content:center;align-items:center;" >
	    	<div>
				<h3 style="margin-top: 0px; margin-bottom: 0px;" >Nova Dev</h3><p id="subtitle" class="sub" >Tous ce que vous voullez...</p>
			</div>
	    </div>
    </div>
    <div class="aboout">
		<div class="inscrip" style="display:flex;justify-content:center;align-items:center;" >
			<div>
			@if (Auth::guest())
				<center>
					<form  method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<ul class="list-inline">
							<li style="vertical-align: middle;" >
								<input type="email" class="form-control" style="width: 300px; border: 1px solid rgb(223, 0, 36);" placeholder="Votre E-Mail" name="email" value="{{ old('email') }}">
							</li>
							<li style="vertical-align: middle;" >
								<input type="password" class="form-control" style="width: 300px; border: 1px solid rgb(223, 0, 36);" placeholder="Votre Mot de Passe" name="password">
							</li>
							<li>
								<input type="submit" class="btn" style="background: rgb(223, 0, 36);color:#fff;" value="Connecter">
							</li>

						</ul>
						<ul class="list-inline">
							<li style="vertical-align: middle;" >
								<input type="checkbox" name="remember"> Garde ma session <br>
								<a href="{{ url('/password/email') }}" style="color: rgb(223, 0, 36); font-weight: bolder;" >Mot de passe oublie?</a>
							</li>
							<li> <strong> OU Inscrivez vous </strong></li>
							<li>
								<a href="/auth/register">Inscription avec NovaDev</a><br>
								<a href="/auth/facebook"><img width="150px" src="http://localhost:8080/images/bouton-inscription-facebook.png"></a>
							</li>
						</ul>
					</form>
				</center>
					@else
						<h1 onclick="window.location.replace('http://localhost:8080/profile/{{ Auth::user()->id }}')" > Bonjour {{ Auth::user()->name }}</h1>
						<a href="{{ url('/auth/logout') }}" style="color: rgb(223, 0, 36);" >Se deconnecter</a>
					@endif
			</div>
		</div>
		<div class="pop_cat" >
	    	<center><div class="topic1" >Categories polpulaire</div></center>
			<center style="margin-top: 20px;" >
				<ul class="list-inline">
				  <li><a href="http://localhost:8080/javascript" ><img class="over"  src="http://localhost:8080/images/cat_icons/PNG/128/1%20(12).png"></a></li>
				  <li><a href="http://localhost:8080/php" ><img class="over"  src="http://localhost:8080/images/cat_icons/PNG/128/1%20(11).png"></a></li>		
				  <li><a href="http://localhost:8080/linux" ><img  class="over" src="http://localhost:8080/images/cat_icons/PNG/128/1%20(8).png"></a></li>		
				  <li><a href="http://localhost:8080/html" ><img  class="over" src="http://localhost:8080/images/cat_icons/PNG/128/1%20(14).png"></a></li>		
				  <li><a href="http://localhost:8080/visualstudio" ><img class="over"  src="http://localhost:8080/images/cat_icons/PNG/128/1%20(4).png"></a></li>		
				  <li><a href="http://localhost:8080#plusplus" ><img class="over"  src="http://localhost:8080/images/cat_icons/PNG/128/plus.png"></a></li>		
				</ul>
			</center>
		</div>
    </div>

    <div class="services">
    	<div class="help">
			<div   style="height:100%;display:flex;justify-content:center;align-items:center;" >
				<ul class="list-inline">
				  <li class="notalone" >
				  	<strong>Vous n'êtes pas seul !</strong><br>
				  	<small>Nous sommes ici pour vous aider à résoudre vos problèmes,<br> vous donner des conseils, rendre vos  idées plus puissant et plus simple.</small>
				  </li>
				  <li><img width="128px" src="http://localhost:8080/images/help.png"></li>
				</ul>
			</div>
		</div>
    </div>

    <div class="catgs">
		<div>		
			<center><h1 style="color: rgb(80, 75, 90);" id="plusplus">Liste des forums</h1></center>
			<div class="row">
			<?php $titlecount=0; ?>
			@foreach( $categories as $categorie )
			  <div class="col-sm-6 col-md-4">
			    <div class="thumbnail" style="min-height: 169px;" >
			    	<ul class="list-inline" style="margin-bottom: 0px;" >
				  		<li style="vertical-align: middle;" ><img class="over" src="http://localhost:8080/images/cat_icons/PNG/64/{{ $categorie->image_link }}" ></li>
				  		<li style="vertical-align: middle; font-size: 30px;"><a href="http://localhost:8080/{{ $categorie->nom }}" >{{ $categorie->nom }}</a></li>
				  	</ul>
			      <div class="caption">
			        <p><?php echo substr($categorie->description, 0, 85); ?></p>
			        <hr style="margin-top: 5px; margin-bottom: 5px;">
			        @if($categorie->last_post($categorie->id))
			        <a href="http://localhost:8080/post/{{ $categorie->last_post($categorie->id)->id }}" class="homelink" ><?php echo (strlen($categorie->last_post($categorie->id)->title)<40) ? $categorie->last_post($categorie->id)->title : substr( $categorie->last_post($categorie->id)->title ,0,40)."..." ;  ?></a>
			        @else
			        <a href="http://localhost:8080/createpost/{{ $categorie->id }}" class="homelink">Etre le premier qui pose une question sur cette catégorie</a>
			        @endif
			      </div>
			    </div>
			  </div>
			<?php $titlecount++; ?>
			@endforeach
			@if(!Auth::guest() && Auth::user()->profile=="admin" )
				<a href="http://localhost:8080/newCategorie"> 
				<div class="col-sm-6 col-md-4">
			    <div class="thumbnail" style="min-height: 169px;" >
			    	<ul class="list-inline" style="margin-bottom: 0px;" >
				  		<li style="vertical-align: middle; font-size: 30px;">Cree une categorie</li>
				  		 <li><center><img class="over" width="100px" height="100px" src="http://localhost:8080/images/cat_icons/PNG/128/plus.png"></center></li>		
				  	</ul>
			    </div>
			  </div>
			  </a>
			@endif
			</div>
		</div>
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
		<div style="margin-top:10px;margin-left: 100px; margin-right: 100px;text-align:center;" >PFE Forum Informatique Réalise 2015-2016 Par: Z.SALAH-EDDINE et A.SMLALI</div>
    </div>
<!-- <div class="toto">
<div id="test1" >
	<div id="test2" style="display:flex;align-items:flex-end;">
		<div class="img_infos">
			<strong>Forum Java</strong><br>
			<small>Posts: 100 | Dernier post: .... </small>
		</div>
	</div>
</div></div> -->
</body>
</body>
</html>

