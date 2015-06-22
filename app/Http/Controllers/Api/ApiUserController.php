<?php namespace DCN\Http\Controllers\Api;

use Auth;
use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use DCN\Http\Requests\UserRequest;
use DCN\Permission;
use DCN\User;
use DCN\Role;
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
            /*
             * Because anyone can register an account
             * Were going to just create users at will
             */
            $user = User::create($request->except('status','status_ts'));
            /*
             * Because all users are members Lets assign that role.
             */
            $role=Role::where('slug','member')->first();
            $user->attachRole($role);
            /*
             * Anything additional needs permissions....
             */
            if(Auth::check()) {
                if (Auth::user()->can('user.roles')) {
                    foreach ($request->get('roles') as $role) {
                        $role = Role::where('slug', $role)->first();
                        $user->attachRole($role);
                    }
                }
                if (Auth::user()->can('user.permissions')) {
                    foreach ($request->get('permission') as $pid) {
                        $user->attachPermission(Permission::find($pid));
                    }
                }
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
            /*
             * Setup an Array of Errors
             */
            $errors = array();
            /*
             * If the current user has the User Edit Permission Update The User
             */
            foreach($request->except('password','status','status_ts') as $key => $value){
                if($user->isFillable($key))
                {
                    if(Auth::user()->can('user.edit')){
                        $user->update([$key => $value]);
                    }else{
                        $errors[] = "No Permission To Edit User";
                        break;
                    }
                }
            }
            /*
             * Update the user status
             * lock/unlock
             * banned/unbanned
             * registered/active
             */
            if(Auth::user()->can('user.lock|user.unlock|user.ban|user.unban')){
                switch($request->only('status'))
                {
                    case "locked":
                        if($user->status!="locked" && Auth::user()->can('user.lock'))
                            $user->update(['status' => $request->input('status')]);
                        else
                            $errors[] = "No Permission to Lock User";
                        break;
                    case "banned":
                        if($user->status!="banned" && Auth::user()->can('user.ban'))
                            $user->update(['status' => $request->input('status')]);
                        else
                            $errors[] = "No Permission to Ban User";
                        break;
                    default:
                        $status=$request->input('status');
                        if(isset($status)){
                            if($user->status=="locked" && Auth::user()->can('user.unlock'))
                                $user->update(['status' => $request->input('status')]);
                            elseif($user->status=="locked" && Auth::user()->can('user.unban'))
                                $user->update(['status' => $request->input('status')]);
                            else
                                $errors[] = "No Permission to Unlock or Unban User";
                        }
                        break;
                }
            }elseif($user->status != $request->only('status')){
                $errors[] = "No Permission to Update User Status!";
            }
            /*
            * If the current user has the User Reset Permission Update The Users Password
            */
            if(Auth::user()->can('user.reset')) {
                if (!is_null($request->input('password')) && $request->input('password') !== '') {
                    $user->update(['password' => $request->input('password')]);
                }
            }else{
                if (!is_null($request->input('password')) && $request->input('password') !== '') {
                    $errors[] = "No Permission to Reset User Passwords";
                }
            }

            /*
            * If the current user has the User Roles Permission Update The Users Role
            */
            if(Auth::user()->can('user.roles')) {
                if (!is_null($request->get('roles'))) {
                    $requestRoles = $request->get('roles');
                    foreach ($user->roles as $role) {
                        //Check if the user already has the role requested
                        if (in_array($role->slug, $requestRoles)) {
                            $exists = array_search($role->slug, $requestRoles);
                            //Unset from the requested array, as the user already has this role
                            unset($requestRoles[$exists]);
                        } else {
                            //User has a role that wasn't specified
                            $user->detachRole($role);
                        }
                    }
                    //Add Roles to the user that they don't already have
                    foreach ($requestRoles as $role) {
                        $role = Role::where('slug', $role)->first();
                        $user->attachRole($role);
                    }
                }
            }else{
                if (!is_null($request->get('roles')))
                    $errors[] = "No Permission to Change User Roles";
            }
            /*
            * If the current user has the User Roles Permission Update The Users Role
            */
            if(Auth::user()->can('user.permissions')) {
                $user->detachAllPermissions();
                //Update The Permissions
                if (!is_null($request->get('permission'))) {
                    foreach ($request->get('permission') as $pid) {
                        $user->attachPermission(Permission::find($pid));
                    }
                }
            }else{
                if (!is_null($request->get('permission')))
                    $errors[] = "No Permission to Change User Permissions";
            }

            return Response::json(array(
                'success' => true,
                'user'   => $user,
                'errors' => $errors
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
            if(Auth::user()->can('user.delete')){
                $user->delete();
                return Response::json(array(
                    'completed' => true
                ));
            }else{
                return Response::json(array(
                    'success' => false,
                    'errors'   => ['Not Authorized to delete users']
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

}
