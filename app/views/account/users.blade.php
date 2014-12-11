@extends('layout.main')

@section('content')
<div class="panel panel-primary" style="width:800px; margin:20px auto;">
	<div class="panel-heading">
   	 	<h2 class="panel-title">Korisnici:</h2>
  	</div>
  	<div class="panel-body">
		<div class="container">
			<div class"row">
				<div class="col-md-8">
						@foreach(User::all() as $user)
						<ul class="list-group">
						  	<li class="list-group-item">
						   		<span class="badge">{{$user->todos->count()}}</span>
						   	 	<a href="{{ URL::route('profile-user', $user->username) }}"><h3>{{$user->username;}}</h3></a>
						  	</li>
						</ul>
						@endforeach
				</div>
			</div>
		</div>
	</div>
</div>

@stop
