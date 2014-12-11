@extends('layout.main')

@section('content')
<div class="well" style="width:800px; margin:20px auto;">
	<form role="form" action="{{ URL::route('account-change-password-post') }}" method="post">
		<div class="form-group">
				<h3><b><u>Promjena zaporke:</u></b></h3>
				<hr>
		</div>

		<div class="form-group">
			<label for="old_password">Stara zaporka:</label>
			<input type="password" class="form-control"  name="old_password" id="old_password">
			@if($errors->has('old_password'))
				<p>{{ $errors->first('old_password') }}</p>
			@endif<br>
		</div>

		<div class="form-group">
			<label for="password">Nova zaporka:</label>
			<input type="password" class="form-control"  name="password" id="password">
			@if($errors->has('password'))
				<p>{{ $errors->first('password') }}</p>
			@endif<br>
		</div>

		<div class="form-group">
			<label for="password_again">Ponovi novu zaporku:</label>
			<input type="password" class="form-control" name="password_again" id="password_again">
			@if($errors->has('password_again'))
				<p>{{ $errors->first('password_again') }}</p>
			@endif
		</div>

		<br>
		<input class="btn btn-primary" type="submit" value="Promijeni zaporku">
		{{ Form::token(); }}
	</form>
</div>
@stop