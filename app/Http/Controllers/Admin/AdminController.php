<?php namespace DCN\Http\Controllers\Admin;

use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use Illuminate\Http\Request;

class AdminController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        return view('backend.index');
    }

}
