<?php namespace DCN\Http\Controllers;

use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use DCN\Page;
use Illuminate\Http\Request;

class PageController extends Controller {

	public function getPage(Page $page)
    {
        return view('frontend.page',compact('page'));
    }

}
