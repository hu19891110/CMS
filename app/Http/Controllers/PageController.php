<?php namespace DCN\Http\Controllers;

use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use DCN\Page;
use Illuminate\Http\Request;
use View;

class PageController extends Controller {

	public function getPage(Page $page)
    {
        if($page->system && View::exists("custom-pages.".$page->slug))
            return view('custom-pages.'.$page->slug,compact('page'));
        else
            return view('frontend.page',compact('page'));
    }

}
