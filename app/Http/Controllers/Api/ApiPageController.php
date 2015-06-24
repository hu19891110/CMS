<?php namespace DCN\Http\Controllers\Api;

use Auth;
use DCN\Http\Requests;
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
                $page = Page::create($request->all());

                //Handle The Page Order
                self::pageOrder($request->only('pageOrder'),$page->id);
            }
            return Response::json(array(
                'success' => true,
                'page'   => $page
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
            $page->update($request->all());

            self::pageOrder($request->only('pageOrder'));

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
            {
                if($raw['item_id']=="NEWPAGE")
                {
                    $raw['item_id']=$newPageID;
                }
            }

            $page = Page::find($raw['item_id']);
            $page->move($raw['parent_id'],$raw['left'],$raw['right'], $raw['depth']);
        }

        Page::rebuild(true);
        return;
    }

}
