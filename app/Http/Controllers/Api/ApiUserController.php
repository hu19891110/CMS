<?php namespace DCN\Http\Controllers\Api;

use Auth;
use DCN\Events\UserBanned;
use DCN\Events\UserCreated;
use DCN\Events\UserDeleted;
use DCN\Events\UserEdited;
use DCN\Events\UserLocked;
use DCN\Events\UserPasswordChanged;
use DCN\Events\UserUnbanned;
use DCN\Events\UserUnlocked;
use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use DCN\Http\Requests\UserRequest;
use DCN\Permission;
use DCN\User;
use DCN\Role;
use Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ApiUserController extends Controller {

    /**
     * Construction Method
     *
     * Middleware is assigned here
     */
    public function __construct()
    {
        $this->middleware('permission:user.delete',['only'=>['destroy']]);
    }

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
            Event::fire(new UserCreated($user));

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
        if(Auth::user()->allowed('user.edit',$user,true,'id') || Auth::user()->can('user.edit')){
            $roles = Role::all()->groupBy('parent_id');
            return view('api.user.edit', compact('user','roles'));
        }
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

            //Check if user is allowed to edit the requested user.
            if(Auth::user()->allowed('user.edit',$user,true,'id') || Auth::user()->can('user.edit')) {
                $user->update($request->except('password', 'status', 'status_ts'));
            }else{
                $errors[] = "No Permission to Edit This User";
            }

            /*
             * Update the user status
             * lock/unlock
             * banned/unbanned
             * registered/active
             */
            if (Auth::user()->can('user.lock|user.unlock|user.ban|user.unban')) {
                switch ($request->input('status')) {
                    case "locked":
                        if ($user->status != "locked" && Auth::user()->can('user.lock')) {
                            $user->update(['status' => $request->input('status')]);
                            Event::fire(new UserLocked($user));
                        } else
                            $errors[] = "No Permission to Lock User";
                        break;
                    case "banned":
                        if ($user->status != "banned" && Auth::user()->can('user.ban')){
                            $user->update(['status' => $request->input('status')]);
                            Event::fire(new UserBanned($user));
                        }else
                            $errors[] = "No Permission to Ban User";
                        break;
                    default:
                        $status = $request->input('status');
                        if (isset($status)) {
                            if ($user->status == "locked" && Auth::user()->can('user.unlock')) {
                                $user->update(['status' => $request->input('status')]);
                                Event::fire(new UserUnlocked($user));
                            } elseif ($user->status == "locked" && Auth::user()->can('user.unban')){
                                $user->update(['status' => $request->input('status')]);
                                Event::fire(new UserUnbanned($user));
                            }else
                                $errors[] = "No Permission to Unlock or Unban User";
                        }
                        break;
                }
            } elseif ($user->status != $request->input('status')) {
                $errors[] = "No Permission to Update User Status!";
            }
            /*
             * If the current user has the User Roles Permission Update The Users Role
             */
            if (Auth::user()->can('user.permissions')) {
                $user->detachAllPermissions();
                //Update The Permissions
                if (!is_null($request->get('permission'))) {
                    foreach ($request->get('permission') as $pid) {
                        $user->attachPermission(Permission::find($pid),TRUE);
                    }
                }
                if (!is_null($request->get('permissionDenied'))) {
                    foreach ($request->get('permissionDenied') as $pid) {
                        $user->attachPermission(Permission::find($pid),FALSE);
                    }
                }
            } else {
                if (!is_null($request->get('permission')))
                    $errors[] = "No Permission to Change User Permissions";
            }

            /*
             * If the current user has the User Reset Permission Update The Users Password
             * Or if the user is updating their own password.
             */
            if (Auth::user()->allowed('user.reset',$user,true,'id') || Auth::user()->can('user.reset')) {
                if (!is_null($request->input('password')) && $request->input('password') !== '') {
                    $user->update(['password' => $request->input('password')]);
                    Event::fire(new UserPasswordChanged($user));
                }
            } else {
                if (!is_null($request->input('password')) && $request->input('password') !== '') {
                    $errors[] = "No Permission to Reset User Passwords";
                }
            }


            /*
            * If the current user has the User Roles Permission Update The Users Role
            */
            if (Auth::user()->can('user.roles')) {
                if (!is_null($request->get('roles'))) {
                    //GRANTED ROLES
                    $requestRoles = $request->get('roles');
                    foreach ($user->grantedRoles()->get() as $role) {
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
                        $user->attachRole($role,TRUE);
                    }
                }
                if (!is_null($request->get('rolesDenied'))) {
                    //DENIED ROLES
                    $requestRoles = $request->get('rolesDenied');
                    foreach ($user->deniedRoles()->get() as $role) {
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
                        $user->attachRole($role, FALSE);
                    }
                }else{
                    foreach ($user->deniedRoles()->get() as $role)
                        $user->detachRole($role);
                }
            } else {
                if (!is_null($request->get('roles')))
                    $errors[] = "No Permission to Change User Roles";
            }

            Event::fire(new UserEdited($user));
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
                Event::fire(new UserDeleted($user));
                return Response::json(array(
                    'completed' => true
                ));
            }else{
                return Response::json(array(
                    'success' => false,
                    'error'   => ['Not Authorized to delete users']
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
