<?php

Route::get('/', array(
	'as' => 'home',
	'uses' => 'HomeController@home'
));




/*
| Authenticated group in filters
*/
Route::group(array('before' => 'auth'), function() {

 	//CSRF
	Route::group(array('before' => 'csrf'), function() {


		Route::post('/account/change-password', array(
		'as' => 'account-change-password-post',
		'uses' => 'AccountController@postChangePassword'
		));

		Route::post('/todo/create', array(
			'as' => 'todo-create',
			'uses' => 'TodoController@postTodoCreate'
		));

		Route::post('/todo/delete', array(
			'as' => 'todo-delete',
			'uses' => 'TodoController@postTodoDelete'
		));

	});

	Route::get('/account/users', array(
		'as' => 'account-users',
		'uses' => 'AccountController@getUsers'
	));


	Route::get('/account/change-password', array(
		'as' => 'account-change-password',
		'uses' => 'AccountController@getChangePassword'
	));

	//Sign out
	Route::get('/account/sign-out', array(
		'as' => 'account-sign-out',
		'uses' => 'AccountController@getSignOut'
	));

	Route::get('/user/{username}', array(
	'as' => 'profile-user',
	'uses' => 'ProfileController@user'
	));

});



/*
| Unauthenticated group
*/
Route::group(array('before' => 'guest'), function() {

	/*
	| CSRF protection group
	*/
	Route::group(array('before' => 'csrf'), function() {

		/*
		| Create account (POST)
		*/
		Route::post('/account/create',array(
			'as' => 'account-create-post',
			'uses' => 'AccountController@postCreate'
		));

		Route::post('/account/sign-in',array(
			'as' => 'account-sign-in-post',
			'uses' => 'AccountController@postSignIn'
		));




	});


	Route::get('/account/signin',array(
		'as' => 'account-sign-in',
		'uses' => 'AccountController@getSignIn'
	));

	/*
	| Create account (GET)
	*/
	Route::get('/account/create',array(
		'as' => 'account-create',
		'uses' => 'AccountController@getCreate'
	));

	// Kod za aktivaciju
	Route::get('/account/activate/{code}', array(
		'as' => 'account-activate',
		'uses' => 'AccountController@getActivate'
	));

});