<?php namespace DCN\Http\Controllers\Api;

use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use DCN\Http\Requests\UserRequest;
use DCN\User;
use DCN\Role;
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
        $roles = Role::all()->groupBy('level');
        return view('api.user.create',compact('roles'));
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
            foreach($request->get('roles') as $role)
            {
                $role=Role::where('slug',$role)->first();
                $user->attachRole($role);
            }
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
        $roles = Role::all()->groupBy('level');
        return view('api.user.edit', compact('user','roles'));
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
            //Update The User
            $user->update($request->except('password'));
            //Update The Password
            if(!is_null($request->input('password'))&&$request->input('password')!=='')
            {
                $user->update();
            }
            //Update The Roles
            if(!is_null($request->get('roles')))
            {
                $requestRoles=$request->get('roles');
                foreach($user->roles as $role)
                {
                    //Check if the user already has the role requested
                    if(in_array($role->slug,$requestRoles))
                    {
                        $exists=array_search($role->slug,$requestRoles);
                        //Unset from the requested array, as the user already has this role
                        unset($requestRoles[$exists]);
                    }else{
                        //User has a role that wasn't specified
                        $user->detachRole($role);
                    }
                }
                //Add Roles to the user that they don't already have
                foreach($requestRoles as $role)
                {
                    $role=Role::where('slug',$role)->first();
                    $user->attachRole($role);
                }
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
