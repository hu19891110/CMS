<?php namespace DCN\Http\Controllers\Api;

use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;
use DCN\Role;

use DCN\Http\Requests\RoleRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiRoleController extends Controller {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        $roles = Role::paginate(10);
        return Response::json(array(
            'success' => true,
            'roles'   => $roles->toArray()
        ));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
        return view('api.role.create');
	}

    /**
     * Store a newly created resource in storage.
     *
     * @param RoleRequest $request
     * @return Response
     */
	public function store(RoleRequest $request)
	{
        try{
            $role = Role::create($request->all());
            return Response::json(array(
                'success' => true,
                'role'   => $role
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
     * @param Role $role
     * @return Response
     * @internal param int $id
     */
	public function show(Role $role)
	{
        return Response::json(array(
            'success' => true,
            'user'   => $role
        ));
	}

    /**
     * Show the form for editing the specified resource.
     *
     * @param Role $role
     * @return Response
     * @internal param int $id
     */
	public function edit(Role $role)
	{
        return view('api.role.edit', compact('role'));
	}

    /**
     * Update the specified resource in storage.
     *
     * @param Role $role
     * @param RoleRequest $request
     * @return Response
     * @internal param int $id
     */
	public function update(Role $role, RoleRequest $request)
	{
        try
        {
            $role->update($request->all());

            return Response::json(array(
                'success' => true,
                'role'   => $role
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
     * @param Role $role
     * @return Response
     * @internal param int $id
     */
	public function destroy(Role $role)
	{
        try{
            $role->delete();
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
