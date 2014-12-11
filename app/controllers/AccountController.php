<?php

class AccountController extends BaseController {

	public function getSignIn() {
		return View::make('account.signin');
	}


	public function postSignIn() {
		$validator = Validator::make(Input::all(), array(
			'email' => 'required|email',
			'password' => 'required|min:6'
		));

		if($validator->fails()) {
			return Redirect::route('account-sign-in')->withErrors($validator)->withInput();
		} else {

			$remember = (Input::has('remember')) ? true : false;

			//Drugi parametar je remember me f
			$auth = Auth::attempt(array(
				'email' => Input::get('email'),
				'password' => Input::get('password'),
				'active' => 1
			),$remember);

			if($auth) {
				//Redirect to page
				//return Redirect::intended('/');
				return Redirect::route('profile-user', Auth::user()->username)->with('globale','Prijavljeni ste!');
			} else {
				return Redirect::route('account-sign-in')->with('global','Podatci koje ste unijeli nisu ispravni.');
			}

		}

		return Redirect::route('account-sign-in')->with('global','Naišli smo na problem pri prijavi.');
	}

	public function getSignOut() {
		Auth::logout();
		return Redirect::route('home');
	}

	public function getCreate() {
		return View::make('account.create');
	}

	public function postCreate() {
		$validator = Validator::make(Input::all(), array(
			'email' => 'required|max:50|email|unique:users',
			'username' => 'required|max:20|min:3|unique:users',
			'password' => 'required|min:6',
			'password_again' => 'required|same:password',
		));

		if($validator->fails()) {
			return Redirect::route('account-create')
			->withErrors($validator)->withInput();
		} else {

			$email = Input::get('email');
			$username = Input::get('username');
			$password = Input::get('password');

			// Email aktiv kod
			$code = str_random(60);

			// 'active' => 0 sa mailom
			$user = User::create(array(
				'email' => $email,
				'username' => $username,
				'password' => Hash::make($password),
				'code' => $code,
				'active' => 1
			));

			if($user) {
				
				/*
				|
				|	Ukljuciti za mail aktivaciju ˇ
				|	+ ^ active = '0'	
				|	+ Mail.php podaci
				*/
				// Use closure
					/*
					Mail::send('emails.auth.activate', array('link' => URL::route('account-activate',$code), 'username' => $username), function($message) use ($user) {
						$message->to($user->email, $user->username)->subject('Aktivirajte svoj račun.');
					});
					*/

				//Flashanje sa with() metodom
				return Redirect::route('home')
				->with('globale', 'Vaš račun je kreiran. Mail za aktiviranje je poslan na vašu email adresu.');
			}
		}
	}

	// Mail aktivacija
	public function getActivate($code) {
		$user = User::where('code', '=', $code)->where('active', '=', 0);
	
		if($user->count()) {
			$user = $user->first();

			//Update usera da bude aktivan
			$user->active = 1;
			$user->code = '';

			if($user->save()) {
				return Redirect::route('home')->with('globale','Račun je aktiviran. Prijavite se!');
			}
		}

		return Redirect::route('home')->with('global', 'Došlo je do problema pri aktiviranju računa.');
	}

	public function getChangePassword() {
		return View::make('account.password');
	}

	public function postChangePassword() {
		$validator = Validator::make(Input::all(), array(
			'old_password' => 'required',
			'password' => 'required|min:6',
			'password_again' => 'required|same:password'
		));

		if($validator->fails()) {
			return Redirect::route('account-change-password')->withErrors($validator);
		} else {
			$user = User::find(Auth::user()->id);

			$old_password = Input::get('old_password');
			$password = Input::get('password');

			if(Hash::check($old_password, $user->getAuthPassword())) {
				$user->password = Hash::make($password);

				if($user->save()) {
					return Redirect::route('home')->with('globale', 'Šifra je promijenjena.');
				}
			} else {
				return Redirect::route('account-change-password')->with('global','Stara šifra nije ispravna.');
			}
 		}

		return Redirect::route('account-change-password')->with('global', 'Šifra ne moze biti promijenjena.');
	}

	public function getUsers() {
		$users = User::all();

		return View::make('account.users');
	}

	
}