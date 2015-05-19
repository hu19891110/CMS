<?php namespace DCN\Http\Controllers\Api;

use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use DCN\Http\Requests\PageRequest;
use DCN\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiPageController extends Controller {

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
            $page = Page::create($request->all());
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

}
