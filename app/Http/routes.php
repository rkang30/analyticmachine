<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('/sendemail', 'IntroController@processemail');

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();

    Route::get('/home', 'ProjectController@intro');
    
    Route::group(['prefix' => 'projects'], function(){
        Route::get('home', 'ProjectController@home');
	    Route::get('lists', 'ProjectController@projectlists');
	    Route::get('new', 'ProjectController@create');
	    Route::post('new', 'ProjectController@store');
        Route::get('detail/{slug}', 'ProjectController@showdetail');
	    Route::get('detail/{slug}/data', 'ProjectController@showdetaildata');
    });

    Route::group(['prefix' => 'data'], function(){
	    Route::get('upload', 'ProjectController@upload');
	    Route::post('upload', 'ProjectController@store');    	
    });

});
