
@extends('app')

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<div class="panel-heading" style='background-image: linear-gradient(125deg, transparent 30%, rgba(166, 200, 31, 0.8)), linear-gradient(45deg, rgb(32, 114, 97), rgb(0, 43, 54)); color: rgb(255, 255, 255); font-size: 20px; font-family: "Roboto-Light";'>Ajouter categorie</div>
				<div class="panel-body">
					@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> merci de bien remplre les champs.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
{!! Form::open(['url' => '/Categcereated/','files'=>'true','method' => 'post'])!!}	
	<div >
		<div class="form-group">
			<input type="file" name="image">
		</div>
		<div>
			<label >Titre</label>
			<input type="text" name="titre" class="form-control">
		</div>
		<div class="form-group">
			<label>Description</label>
			<textarea name="description" class="form-control"></textarea>
		</div>
		<div>
		<button type="submit" class=" btn">crée</button>
		</div>
	</div>
{!! Form::close() !!}

				
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

