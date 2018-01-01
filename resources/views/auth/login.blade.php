@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" style='background-image: linear-gradient(125deg, transparent 30%, rgba(166, 200, 31, 0.8)), linear-gradient(45deg, rgb(32, 114, 97), rgb(0, 43, 54)); color: rgb(255, 255, 255); font-size: 20px; font-family: "Roboto-Light";'>Ce connecter</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Problemes dans votre formulaire.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif

					<form class="form-horizontal" role="form" method="POST" action="{{ url('/auth/login') }}">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">

						<div class="form-group">
							<label class="col-md-4 control-label">E-Mail</label>
							<div class="col-md-6">
								<input type="email" class="form-control" name="email" value="{{ old('email') }}">
							</div>
						</div>

						<div class="form-group">
							<label class="col-md-4 control-label">Mot de passe</label>
							<div class="col-md-6">
								<input type="password" class="form-control" name="password">
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<div class="checkbox">
									<label>
										<input type="checkbox" name="remember"> Garde ma session
									</label>
								</div>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-6 col-md-offset-4">
								<button type="submit" class="btn" style="background: rgb(22, 92, 84) none repeat scroll 0% 0%; color: rgb(255, 255, 255); font-weight: bolder;" >Connecter</button>

								<a class="btn btn-link" href="{{ url('/password/email') }}">Mot de pass oublie</a>
							</div>
						</div>
					</form>
					<center><a href="/auth/facebook">Facebook</a></center>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
