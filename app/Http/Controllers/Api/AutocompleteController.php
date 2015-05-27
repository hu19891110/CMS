<?php namespace DCN\Http\Controllers\Api;

use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use DCN\Permission;
use DCN\Role;
use DCN\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;

class AutocompleteController extends Controller {

	public function getResults()
    {
        $type = Input::route('type');
        $q = Input::get('q');
        $response = array();
        switch($type)
        {
            case "user":
                foreach(User::search($q)->limit(5)->get() as $user)
                {
                    $response[$user->id] = ['id'=>$user->id,'username'=>$user->username];
                }
                break;
            case "page-owner":
                dd(User::with(['permissions'=> function($q)
                {
                    $q->where('slug', 'page.owner');
                }])->get());


                User::select([
                    'permissions.*',
                    'permission_role.created_at as pivot_created_at',
                    'permission_role.updated_at as pivot_updated_at'
                ])->join('permission_role', 'permission_role.permission_id', '=', 'permissions.id')
                    ->join('roles', 'roles.id', '=', 'permission_role.role_id')
                    ->whereIn('roles.id', $roles)
                    ->orWhere('roles.level', '<', $this->level())
                    ->groupBy('permissions.id');














                foreach(User::search($q)->whereHas('getermissions',function($q){$q->where('slug','page.owner');})->get() as $user)
                {
                    $response[$user->id] = ['id'=>$user->id,'username'=>$user->username];
                }
                break;
            case "page-creator":
                foreach(User::search($q)->limit(5)->get() as $user)
                {
                    $response[$user->id] = ['id'=>$user->id,'username'=>$user->username];
                }
                break;
            case "permission":
                foreach(Permission::search($q)->limit(5)->get() as $permission)
                {
                    $response[$permission->id] = ['id'=>$permission->id,'name'=>$permission->name];
                }
                break;
            default:
                break;
        }
        return \Response::json($response);
    }

}
