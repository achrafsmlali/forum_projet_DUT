<?php

Route::get('/','IndexController@home');
Route::get('/aboutus','IndexController@aboutus');
/*Route::get('/contactus','IndexController@contactus');
Route::get('/contactus','IndexController@contactus');*/
Route::get('/post','IndexController@index');

Route::get('/auth/login','Auth\AuthController@getLogin');
Route::post('/auth/login','Auth\AuthController@postLogin');

Route::get('/password/email','Auth\PasswordController@getEmail');
Route::post('/password/email','Auth\PasswordController@postEmail');
Route::get('/password/reset/{token}','Auth\PasswordController@getReset');
Route::post('/password/reset','Auth\PasswordController@postReset');

Route::get('auth/register','Auth\AuthController@getRegister');
Route::post('auth/register','Auth\AuthController@postRegister');

Route::get('/auth/logout','Auth\AuthController@getLogout');

Route::get('/auth/facebook','Auth\AuthController@redirectToProvider');
Route::get('/callback','Auth\AuthController@handleProviderCallback');

//Route::get('/profile/{name}','');

Route::get('/post/{id}','PostController@show');
Route::get('/post/comments/{id}','PostController@fetch_comments');
Route::get('/post/answers/{id}','PostController@fetch_answers');
Route::post('/post/{id}',[
    						'middleware' => 'auth',
   							'uses' => 'AddCommentsAnswers@create'
			]);



Route::get('/search','PostController@search');
Route::post('/solution',[
    						'middleware' => 'auth',
   							'uses' => 'AddCommentsAnswers@solution'
			]);

Route::get('/newCategorie','CategorieController@index');
Route::post('/Categcereated','CategorieController@create');


Route::get('/edit_profile','ProfileController@create');
Route::post('/edit_profile/{id}','ProfileController@update');
Route::post('/profile_image/{id}','ProfileController@updateimage');

Route::post('/post_up','VoteController@post_up');
Route::post('/post_down','VoteController@post_down');

Route::post('/answer_up','VoteController@answer_up');
Route::post('/answer_down','VoteController@answer_down');

Route::get('/createpost/{id}',['middleware' => 'auth','uses' =>'CreatePost@taging']);
Route::post('/createpost/{id}',['middleware' => 'auth','uses' =>'CreatePost@create']);

Route::get('/profile/{id}','IndexController@showprofile');
Route::post('/profile/{id}','IndexController@deleteaccount');
// Route::post('/createpost','CreatePost@create');

Route::get('/post/edit/{id}',['middleware' => 'auth','uses' => 'PostController@red_update']);
Route::post('/post/edit/{id}',['middleware' => 'auth','uses' => 'PostController@update']);

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('/{categorie}','PostController@showcat');

Route::POST('/deleteanswer',['middleware' => 'auth','uses' => 'AddCommentsAnswers@deleteanswer']);
Route::POST('/deletecomment',['middleware' => 'auth','uses' => 'AddCommentsAnswers@deletecomment']);
Route::POST('/deletepost',['middleware' => 'auth','uses' => 'AddCommentsAnswers@deletepost']);


Route::get('/tag/{tag}','PostController@tagpost');


