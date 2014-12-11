@extends('layout.main')
@section('content')

<div class="well" style="width:800px; margin:20px auto;">
	<form role="form" action="{{URL::route('account-create-post')}}" method="post">
	<!-- error after?? -->
		<div class="form-group">
				<h3><b><u>Registracija</u></b></h3>
				<hr>
		</div>

		<div class="form-group">
			<!-- Stavi stari input -->
			<label for="email">Email:</label>
			<input type="text" class="form-control" name="email" id="email" placeholder="Upiši email" {{ (Input::old('email')) ? 'value="'. e(Input::old('email')) .'"' : '' }}>
			@if($errors->has('email'))
				{{ $errors->first('email') }}
			@endif
		</div>

		<div class="form-group">
			<label for="username">Username:</label>
			<input type="text" class="form-control" name="username" id="username" {{ (Input::old('username')) ? 'value="'. e(Input::old('username')) .'"' : '' }} placeholder="Upiši username">
			@if($errors->has('username'))
				{{ $errors->first('username') }}
			@endif
		</div>

		<div class="form-group">
			<label for="sifra">Zaporka:</label>
			<input type="password" class="form-control" name="password" id="sifra">
			@if($errors->has('password'))
				{{ $errors->first('password') }}
			@endif
		</div>

		<div class="form-group">
			<label for="sifrap">Ponovite zaporku:</label>
			<input type="password" class="form-control" name="password_again" id="sifrap">
			@if($errors->has('password_again'))
				{{ $errors->first('password_again') }}
			@endif
		</div>

		<input class="btn btn-primary" type="submit" value="Kreiraj račun">
		{{Form::token()}}
	</form>
</div>
@stop