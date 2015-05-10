<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'WelcomeController@index');

Route::get('/frontend', function(){
    return view('frontend');
});

Route::get('/backend', function(){
    return view('backend');
});

Route::get('/portal', function(){
    return view('portal');
});