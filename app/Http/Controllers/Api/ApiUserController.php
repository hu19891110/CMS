<?php namespace DCN\Http\Controllers\Api;

use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use DCN\Http\Requests\UserRequest;
use DCN\User;
use Illuminate\Html\FormFacade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiUserController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $users = User::with('roles')->paginate(10);
        return Response::json(array(
            'success' => true,
            'users'   => $users->toArray()
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('api.user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Requests\UserRequest $request
     * @return Response
     */
    public function store(UserRequest $request)
    {
        try{
            $user = User::create($request->all());
            return Response::json(array(
                'success' => true,
                'user'   => $user
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
     * @param User $user
     * @return Response
     * @internal param int $id
     */
    public function show(User $user)
    {
        return Response::json(array(
            'success' => true,
            'user'   => $user
        ));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param User $user
     * @return Response
     * @internal param int $id
     */
    public function edit(User $user)
    {
        return view('api.user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @param User $user
     * @return Response
     * @internal param int $id
     */
    public function update(User $user, UserRequest $request)
    {
        try
        {
            $user->update($request->except('password'));
            if(!is_null($request->input('password'))&&$request->input('password')!=='')
            {
                $user->update($request->only('password'));
            }

            return Response::json(array(
                'success' => true,
                'user'   => $user
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
     * @param User $user
     * @return Response
     * @internal param int $id
     */
    public function destroy(User $user)
    {
        try{
            $user->delete();
            return Response::json(array(
                'success' => true
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
