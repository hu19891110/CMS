<?php

namespace DCN\Http\Controllers\Portal;

use Illuminate\Http\Request;

use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

class PortalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        return view('portal.index');
    }
}
