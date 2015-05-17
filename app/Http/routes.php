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
    Route::resource('role','ApiRoleController');
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

        Route::get('/', [
            'uses'=>'UserController@getIndex',
            'as'=>'admin.users'
        ]);

        Route::get('/create', [
            'uses'=>'UserController@getCreate',
            'as'=>'admin.users.create'
        ]);

        Route::get('/list', [
            'uses'=>'UserController@getList',
            'as'=>'admin.users.list'
        ]);

        Route::get('/edit/{user}', [
            'uses'=>'UserController@getEdit',
            'as'=>'admin.users.edit'
        ]);
    });
    /*
     * Admin - Roles Routes
     */
    Route::group(['prefix'=>'roles'], function() {

        Route::get('/', [
            'uses'=>'RoleController@getIndex',
            'as'=>'admin.roles'
        ]);
        Route::get('/create', [
            'uses'=>'RoleController@getCreate',
            'as'=>'admin.roles.create'
        ]);
        Route::get('/list', [
            'uses'=>'RoleController@getList',
            'as'=>'admin.roles.list'
        ]);

        Route::get('/edit/{role}', [
            'uses'=>'RoleController@getEdit',
            'as'=>'admin.roles.edit'
        ]);
    });
});

/*
 * Layout Routes
 */
Blade::extend(function($view, $compiler) {
    $pattern = $compiler->createMatcher('oneLine');
    $replace = "<?php echo implode(\" \",explode(\"\n\",\$__env->make($2, array_except(get_defined_vars(), array('__data', '__path')))->render())); ?>";
    return preg_replace($pattern, $replace, $view);
});


Route::get('/frontend', function(){
    return view('frontend');
});
Route::get('/guest-only',function(){
    return view('frontend',['content'=>'<h1>Sorry Guests Only!'],['content'=>'<h1>Sorry Guests Only!']);
});
Route::get('/backend', function(){
    return view('backend');
});
Route::get('/portal', function(){
    return view('portal');
});