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

/*
 * API Routes
 */
Route::group(['namespace'=>'Api','prefix'=>'api'], function(){
    /*
     * User Resource API
     */
    Route::resource('user','ApiUserController');
});

/*
 * Authentication Routes
 */
Route::group(['prefix'=>'auth'],function(){
    /*
     * Routes For Login
     */
    Route::get('/login', [
        'uses'=>'AuthController@getLogin',
        'as'=>'auth.login'
    ]);
    Route::post('/login', 'AuthController@postLogin');
    /*
     * Routes for Logout
     */
    Route::get('/logout', [
        'uses'=>'AuthController@getLogout',
        'as'=>'auth.logout'
    ]);
    /*
     * Routes For Registration
     */
    Route::get('/register', [
        'uses'=>'AuthController@getRegister',
        'as'=>'auth.register'
    ]);
    Route::post('/register', 'AuthController@postRegister');

});

/*
 * Admin Routes
 */
Route::group(['namespace'=>'Admin','prefix'=>'admin'], function() {
    /*
     * Index
     *
     * Displays Most Recent User Activity & Stats
     */
    Route::get('/', [
        'uses'=>'AdminController@getIndex',
        'as'=>'admin.dashboard'
    ]);

    /*
     * Admin - Users Routes
     */
    Route::group(['prefix'=>'users'], function() {

        /*
         * Index
         *
         * Displays Most Recent User Activity & Stats
         */
        Route::get('/', [
            'uses'=>'UserController@getIndex',
            'as'=>'admin.users'
        ]);

        /*
         * List
         *
         * Displays A list of all users
         */
        Route::get('/list', [
            'uses'=>'UserController@getList',
            'as'=>'admin.users.list'
        ]);

        /*
         * Edit
         *
         * Displays A list of all users
         */
        Route::get('/edit/{user}', [
            'uses'=>'UserController@getEdit',
            'as'=>'admin.users.edit'
        ]);
    });
});

/*
 * Layout Routes
 */

Route::get('/frontend', function(){
    return view('frontend');
});
Route::get('/backend', function(){
    return view('backend');
});
Route::get('/portal', function(){
    return view('portal');
});

Blade::extend(function($view, $compiler)
{
    $pattern = $compiler->createMatcher('oneLine');
    return preg_replace_callback($pattern, function($matches)
    {
        $param = trim(trim($matches[2], '(\'\')'));
        return implode(" ",explode("\n",View::make($param)->render()));
    }, $view);
});