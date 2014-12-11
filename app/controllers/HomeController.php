<?php

class HomeController extends BaseController {
	public function home() {
		if(Auth::check())
		{
			return Redirect::route('profile-user', Auth::user()->username);
		}
		return View::make('home');
	}
}
