<?php namespace DCN\Http\Controllers\Admin;

use Auth;
use DCN\Page;
use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use DCN\RBAC\Exceptions\PermissionDeniedException;
use Illuminate\Http\Request;

class PageController extends Controller
{
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
        if(Auth::user()->can('page.system'))
            $pages = Page::paginate(10);
        else
            $pages = Page::where('system',FALSE)->paginate(10);

        return view('backend.page.list',compact('pages'));
    }
    public function getEdit(Page $page)
    {
        if($page->system)
            if(!Auth::user()->can('page.system'))
                throw new PermissionDeniedException('page.system');
        return view('backend.page.edit',compact('page'));
    }

    public function getEditInline(Page $page)
    {
        if($page->system)
            if(!Auth::user()->can('page.system'))
                throw new PermissionDeniedException('page.system');
        return view('backend.page.editInline',compact('page'));
    }

}