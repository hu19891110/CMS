<?php namespace DCN\Http\Controllers\Api;

use Auth;
use DCN\Events\PageCreated;
use DCN\Events\PageDeleted;
use DCN\Events\PageEdited;
use DCN\Events\PagePublished;
use DCN\Events\PageUnpublished;
use DCN\Http\Requests;
use Event;
use DCN\Http\Controllers\Controller;
use Illuminate\Support\Collection;

use DCN\Http\Requests\PageRequest;
use DCN\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use League\Flysystem\Exception;
use Psy\Util\Json;

class ApiPageController extends Controller {

    /**
     * Construction Method
     *
     * Middleware is assigned here
     */
    public function __construct()
    {
        $this->middleware('permission:page.*');
        $this->middleware('permission:page.create',['only'=>['create','store']]);
        $this->middleware('permission:page.edit|page.publish|page.unpublish',['only'=>['edit','update']]);
        $this->middleware('permission:page.delete',['only'=>['destroy']]);
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $pages = Page::paginate(10);
        return Response::json(array(
            'success' => true,
            'pages'   => $pages->toArray()
        ));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('api.page.create');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param PageRequest $request
     * @return Response
     */
	public function store(PageRequest $request)
	{
        try{
            if(Auth::user()->can('page.create')) {
                $page = Page::create($request->except('creator_id','pageOrder'));

                //Handle The Page Order
                self::pageOrder($request->only('pageOrder'),$page->id);

                Event::fire(new PageCreated($page));

                return Response::json(array(
                    'success' => true,
                    'page'   => $page
                ));
            }else{
                return Response::json(array(
                    'success' => false,
                    'error'   => 'No Permission To Create Page!'
                ));
            }
        }
        catch(\Exception $e){
            return Response::json(array(
                'success' => false,
                'error'   => $e
            ));
        }
	}

    /**
     * Display the specified resource.
     *
     * @param Page $page
     * @return Response
     * @internal param int $id
     */
	public function show(Page $page)
	{
        return Response::json(array(
            'success' => true,
            'page'   => $page
        ));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param Page $page
     * @return Response
     * @internal param int $id
     */
	public function edit(Page $page)
	{
        return view('api.page.edit', compact('page'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Page $page
     * @param PageRequest $request
     * @return Response
     * @internal param int $id
     */
	public function update(Page $page, PageRequest $request)
	{
        try
        {
            //Check if the page is being published
            if($request->only('status') == "published" && $page->status != "published")
                Event::fire(new PagePublished($page));

            //Check if the page is being unpublished
            if($request->only('status') != "published" && $page->status == "published")
                Event::fire(new PageUnpublished($page));

            //Update the Page
            $page->update($request->all());
            self::pageOrder($request->only('pageOrder'));
            Event::fire(new PageEdited($page));

            //Send Response
            return Response::json(array(
                'success' => true,
                'page'   => $page
            ));
        }
        catch(\Exception $e)
        {
            return Response::json(array(
                'success' => false,
                'error'   => $e
            ));
        }
	}

    /**
     * Remove the specified resource from storage.
     *
     * @param Page $page
     * @return Response
     * @internal param int $id
     */
	public function destroy(Page $page)
	{
        try{
            $page->delete();
            Event::fire(new PageDeleted($page));
            return Response::json(array(
                'completed' => true
            ));
        }
        catch(\Exception $e){
            return Response::json(array(
                'success' => false,
                'error'   => $e
            ));
        }
	}



    /**
     * @param $order
     * @param null $newPageID
     * @throws Exception
     */
    private static function pageOrder($order,$newPageID=null)
    {

        if(array_key_exists('pageOrder',$order))
            $order = $order['pageOrder'];

        $rawPages = json_decode($order,true);

        foreach($rawPages as $raw)
        {
            //Handle New Pages
            if($newPageID!=NULL)
                if($raw['item_id']=="NEWPAGE")
                $raw['item_id']=$newPageID;

            $page = Page::find($raw['item_id']);
            $page->move($raw['parent_id'],$raw['left'],$raw['right'], $raw['depth']);
        }

        Page::rebuild(true);
        return;
    }

}
