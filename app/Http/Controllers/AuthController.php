<?php namespace DCN\Http\Controllers;

use Auth;
use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use DCN\Http\Requests\LoginRequest;
use Illuminate\Http\Request;
use URL;

class AuthController extends Controller {

    /**
     * Construction Method
     *
     * Middleware is assigned here
     */
    public function __construct()
    {
        $this->middleware('guest', ['only' => ['getLogin', 'postLogin', 'getRegister']]);
    }

    /**
     * Display the login page
     *
     * @return \Illuminate\View\View
     */
    public function getLogin()
    {
        return view('auth.login');
    }

    /**
     * Handle a login request
     *
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postLogin(LoginRequest $request)
    {
        if (Auth::attempt($request->except('_token'))) {
            // Authentication passed...
            return redirect()->intended('/');
        }else{
            return redirect(URL::route('auth.login'))->withInput($request->except('password'))->withErrors('Unable To Login At This Time. Check Password');
        }
    }

    /**
     * Logs the user out and redirect to the home page
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function getLogout()
    {
        Auth::logout();
        return redirect('/');
    }


    /**
     * Display the user Registration Page
     *
     * Form is posted to the User Store API
     *
     * @return \Illuminate\View\View
     */
    public function getRegister()
    {
        return view('auth.register');
    }

}
