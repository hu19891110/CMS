<?php namespace DCN\Http\Controllers\Admin;

use DCN\Page;
use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use Illuminate\Http\Request;

class PageController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        //Display Latest User Actions Etc.
        $history = Page::classRevisionHistory();
        return view('backend.page.index',compact('history'));
    }
    public function getCreate()
    {
        return view('backend.page.create');
    }
    public function getList()
    {
        //Display Latest User Actions Etc.wat
        $pages = Page::paginate(10);
        return view('backend.page.list',compact('pages'));
    }
    public function getEdit(Page $page)
    {
        return view('backend.page.edit',compact('page'));
    }

    public function getEditInline(Page $page)
    {
        return view('backend.page.editInline',compact('page'));
    }

}