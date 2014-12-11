@extends('layout.main')

@section('content')
	@if(Auth::check())
		<p>Pozdrav, {{ Auth::user()->username }}</p>
	@else
		<div class="jumbotron" style="width:800px; margin:20px auto; text-align:center;">
		  <h1><b>PlanIt</b></h1>
		  <p>Aplikacija za kreiranje "to-do" lista.</p><hr>
		  <p><a class="btn btn-primary btn-lg" href="{{ URL::route('account-sign-in') }}" role="button">Prijava</a></p>
		  <small>Ili <a href="{{ URL::route('account-create') }}">registracija</a> ako nemate račun.</small>
		</div>
	@endif
@stop


