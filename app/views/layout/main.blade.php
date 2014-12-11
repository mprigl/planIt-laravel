<!DOCTYPE html>
<html>
	<head>
		<title>PlanIt</title>
		{{ HTML::style('css/css/bootstrap.css'); }}
		<link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
		<meta name="csrf-token" content="<?= csrf_token() ?>">
		
		<script>
		$.ajaxSetup({
    		headers: {
        		'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
   			 }
		});
		</script>
		
		@yield('skripte')
	</head>
	<body>

		@include('layout.navigation')

		<!-- Flash ovdje -->
		@if(Session::has('global'))
		<div class="alert alert-danger" role="alert">
			<p>{{ Session::get('global') }}</p>
		</div>
		@endif
		
		
		@if(Session::has('globale'))
		<div class="alert alert-success" role="alert">
			<p>{{ Session::get('globale') }}</p>
		</div>
		@endif
		
		@yield('content')


	</body>
</html>

