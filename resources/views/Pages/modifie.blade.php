
@extends('app')
@section('content')

<div class="container-fluid">

	<div class="row">
		<div class="col-md-8 col-md-offset-2">
							@if (count($errors) > 0)
						<div class="alert alert-danger">
							<strong>Whoops!</strong> Des problemes dans votre formulaire.<br><br>
							<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
							</ul>
						</div>
					@endif
			<div class="panel panel-default">
				<div class="panel-heading" style='background-image: linear-gradient(125deg, transparent 30%, rgba(166, 200, 31, 0.8)), linear-gradient(45deg, rgb(32, 114, 97), rgb(0, 43, 54)); color: rgb(255, 255, 255); font-size: 20px; font-family: "Roboto-Light";'>Modification du profile</div>
				<div class="panel-body">

<div class="media" style="margin-bottom:10px;">
  <div class="media-left">
      <div class="media-object" ><img class="img-circle" src="{{ Auth::user()->image_link }}"></div>
  </div>
  <div class="media-body">
			{!! Form::open(['url' => '/profile_image/'.Auth::user()->id,'files'=>'true'])!!}
			<div id="div_file">
				<ul class="list-inline">
				  <li>Changer l'image : {!! Form::file('image_link',['id'=>'putfile'])!!}</li>
				  <li><input type="submit" class="btn" value="Changer"></li>
				</ul>			
			</div>
{!! Form::close() !!}
  </div>
</div>



{!! Form::open(['url' => '/edit_profile/'.Auth::user()->id,'files'=>'true']) !!}
	Nom d'utilisateur:	
	{!! Form::text('Nom_d\'utilisateur',Auth::user()->name, ['class' => 'form-control', 'placeholder' => 'Voter nom d\'utilisateur']) !!}
	<br>
	Nom:              	
	{!! Form::text('Nom',Auth::user()->first_name,['class' => 'form-control', 'placeholder' => 'Votre Nom'])!!}
	<br>
	Prénom:			  	
	{!! Form::text('Prenom',Auth::user()->lats_name,['class' => 'form-control', 'placeholder' => 'Votre Prenon'] )!!}
	<br>
	Email:
	{!! Form::email('email',Auth::user()->email,['class' => 'form-control', 'placeholder' => 'Votre E-Mail'] )!!}
    <br>
	Date de naissance:	
	<input type="date" value="{{ Auth::user()->birthday }}" name="date_de_naissance" >
	<br>
	Sexe: male 
	<?php if (Auth::user()->sexe=='male'){ ?>
			{!! Form::radio('sexe','male',true)!!}
					  female 	  	
	{!! Form::radio('sexe','female')!!}
	<?php }else{ ?>
			{!! Form::radio('sexe','male')!!}
					  female 	  	
	{!! Form::radio('sexe','female',true)!!}
	<?php } ?>


    <br>
	A propos de moi : 	
	{!! Form::textarea('about_me', Auth::user()->about_me,['class' => 'form-control', 'placeholder' => 'Vous ete qui?'])!!}
    <br>

	
    {!! Form::submit('Editer',['class' => 'btn']) !!}
{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>
</div>
 

@endsection


