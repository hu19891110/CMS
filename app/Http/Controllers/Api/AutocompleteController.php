<?php namespace DCN\Http\Controllers\Api;

use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use DCN\Permission;
use DCN\Role;
use DCN\User;
use DCN\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;

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
                foreach(User::search($q)->limit(5)->get() as $user)
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
        return Response::json($response);
    }

}
