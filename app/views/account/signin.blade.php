 @extends('layout.main')

 @section('content')
 <div class="well" style="width:800px; margin:20px auto;">
	<form role="form" action="{{ URL::route('account-sign-in-post'); }}" method="post">
		
			<div class="form-group">
				<h3><b><u>Prijava</u></b></h3>
				<hr>
			</div>

			<div class="form-group">
				<label for="email">Email:</label>
				<input type="text" class="form-control" name="email" id="email" {{ (Input::old('email')) ? 'value="'. Input::old('email') .'"' : ''  }} placeholder="Upiši email">
				@if($errors->has('email'))
					<p>{{ $errors->first('email') }}</p>
				@endif
			</div>

			<div class="form-group">
				<label for="password">Zaporka:</label>
				<input type="password" class="form-control" name="password" id="password">
				@if($errors->has('password'))
					<p>{{ $errors->first('password') }}</p>
				@endif
			</div>

			<div class="checkbox">
				<label>
					<input type="checkbox" name="remember"> Zapamti me
				</label>
			</div>

			<input class="btn btn-primary" type="submit" value="Prijavi se" />
			{{ Form::token();}}
	</form>
</div>

 @stop