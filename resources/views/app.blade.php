<!DOCTYPE html>
<html>
<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="{{ asset('/bt/css/bootstrap.min.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/bt/css/custom.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('/bt/css/styles.css') }}">
    <script src="{{ asset('/bt/js/jquery.min.js') }}"></script>

</head>
<body>
    <script src="{{ asset('/bt/js/bootstrap.min.js') }}"></script>
<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">NovaDep</a>
    </div>
    <div class="navbar-text navbar-right">
    	<ul class='inline'>
    		<li>
				<ul style="margin-right: 30px; margin-left: 30px;" class="nav nav-pills">
					@if (Auth::guest())
						<li role="presentation" ><a href="{{ url('/auth/login') }}">Connectez-Vous</a></li>
						<li role="presentation" ><a href="{{ url('/auth/register') }}">Inscrivez-Vous</a></li>
					@else
						<li><a href="<?php echo "/profile/".Auth::user()->name;?>">{{ Auth::user()->name }}</a></li>
						<li><a href="{{ url('/auth/logout') }}">Logout</a></li>
					@endif
				</ul>
			</li>
	    	<li class="row">
				<div class="col-lg-6">
				    <div class="input-group">
				      <input type="text" class="form-control" placeholder="Search for...">
				      <span class="input-group-btn">
				        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
				      </span>
				    </div>
				  </div>
			</li>
		</ul>
    </div>
  </div> 
</nav>

<div class="panel panel-default">
  <div class="panel-body">
    <span class="glyphicon glyphicon-search" aria-hidden="true"></span>
    Basic panel example
  </div>
</div>


@yield('content')

<div id="footer">lararararararrara</div>

</body>
</html>
