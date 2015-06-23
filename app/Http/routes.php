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

/*
 * API Routes
 */
Route::group(['namespace'=>'Api','prefix'=>'api'], function(){
    /*
     * User Resource API
     */
    Route::resource('user','ApiUserController');
    Route::resource('role','ApiRoleController');
    Route::resource('page','ApiPageController');

    Route::get('/autocomplete/{type}', [
        'uses'=>'AutocompleteController@getResults',
        'as'=>'api.autocomplete'
    ]);
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
 * Portal Routes
 */
Route::group(['namespace'=>'Portal','prefix'=>'portal', 'middleware' => 'role:member'], function() {
    /*
     * Index
     *
     * Displays Most Recent Activity & Stats For The User
     */
    Route::get('/', [
        'uses' => 'PortalController@getIndex',
        'as' => 'portal.dashboard'
    ]);
});

/*
 * Admin Routes
 */
Route::group(['namespace'=>'Admin','prefix'=>'admin', 'middleware' => 'role:root|admin|admin.*'], function() {
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
    * Admin - Auth Routes
    */
    Route::group(['prefix'=>'auth', 'middleware' => 'role:root|admin|admin.*'], function() {
        /*
         * Admin - Users Routes
         */
        Route::group(['prefix' => 'users'], function () {

            Route::get('/', [
                'uses' => 'UserController@getIndex',
                'as' => 'admin.users'
            ]);

            Route::get('/create', [
                'uses' => 'UserController@getCreate',
                'as' => 'admin.users.create'
            ]);

            Route::get('/list', [
                'uses' => 'UserController@getList',
                'as' => 'admin.users.list'
            ]);

            Route::get('/edit/{user}', [
                'uses' => 'UserController@getEdit',
                'as' => 'admin.users.edit'
            ]);
        });
        /*
         * Admin - Roles Routes
         */
        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', [
                'uses' => 'RoleController@getIndex',
                'as' => 'admin.roles'
            ]);
            Route::get('/create', [
                'uses' => 'RoleController@getCreate',
                'as' => 'admin.roles.create'
            ]);
            Route::get('/list', [
                'uses' => 'RoleController@getList',
                'as' => 'admin.roles.list'
            ]);
            Route::get('/edit/{role}', [
                'uses' => 'RoleController@getEdit',
                'as' => 'admin.roles.edit'
            ]);
        });
        Route::get('/settings', [
            'uses' => 'SettingsController@getAuth',
            'middleware' => 'role:root|admin|admin.settings',
            'as' => 'admin.settings.auth'
        ]);
        Route::post('/settings', [
            'uses' => 'SettingsController@postAuth',
            'middleware' => 'role:root|admin|admin.settings',
            'as' => 'admin.settings.auth.post'
        ]);
    });
    /*
     * Admin - Page Routes
     */
    Route::group(['prefix'=>'pages', 'middleware' => 'role:root|admin|admin.page'], function() {

        Route::get('/', [
            'uses'=>'PageController@getIndex',
            'as'=>'admin.pages'
        ]);
        Route::get('/create', [
            'uses'=>'PageController@getCreate',
            'as'=>'admin.pages.create'
        ]);
        Route::get('/list', [
            'uses'=>'PageController@getList',
            'as'=>'admin.pages.list'
        ]);

        Route::get('/edit/{page}', [
            'uses'=>'PageController@getEdit',
            'as'=>'admin.pages.edit'
        ]);
        Route::get('/edit/{page}/inline', [
            'uses'=>'PageController@getEditInline',
            'as'=>'admin.pages.edit.inline'
        ]);
    });
});

/*
 * Layout Routes
 */
Route::get('/guest-only',function(){
    return view('frontend',['content'=>'<h1>Sorry Guests Only!</h1>']);
});

/*
 * Page Routes
 *
 * Ensure This is always the last active route!
 */
Route::get('{pageUrl?}', [
    'uses'=>'PageController@getPage',
    'as'=>'page'
])->where('pageUrl', '(.*)?');