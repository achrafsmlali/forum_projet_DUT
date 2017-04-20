<?php

Route::get('/','IndexController@index');

Route::get('/auth/login','Auth\AuthController@getLogin');
Route::post('/auth/login','Auth\AuthController@postLogin');

Route::get('auth/register','Auth\AuthController@getRegister');
Route::post('auth/register','Auth\AuthController@postRegister');

Route::get('/auth/logout','Auth\AuthController@getLogout');

Route::get('/auth/facebook','Auth\AuthController@redirectToProvider');
Route::get('/callback','Auth\AuthController@handleProviderCallback');

//Route::get('/profile/{name}','');

Route::get('/post/{id}','PostController@show');
Route::get('/tagg/{id}','PostController@similar_tags');



Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);