<nav>
	
		
	<ul class="nav nav-tabs nav-justified">
			
		@if(Auth::check())
		
			<li role="presentation"><a href="{{ URL::route('profile-user', Auth::user()->username) }}">Profil</a></li>
			<li role="presentation"><a href="{{ URL::route('account-users') }}">Korisnici</a></li>
			<li role="presentation"><a href="{{ URL::route('account-change-password') }}">Promijeni zaporku</a></li>
			<li role="presentation"><a href="{{ URL::route('account-sign-out') }}">Odjavi se</a></li>
		
		@else
		
			<li role="presentation"><a href="{{ URL::route('home') }}">Početna</a></li>
			<li role="presentation"><a href="{{ URL::route('account-sign-in') }}">Prijavi se</a></li>
			<li role="presentation"><a href="{{ URL::route('account-create') }}">Registriraj se</a></li>		
		
		@endif
	</ul>
	
</nav>