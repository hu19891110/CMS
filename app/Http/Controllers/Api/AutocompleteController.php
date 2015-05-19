<?php namespace DCN\Http\Controllers\Api;

use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

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
            default:
                break;
        }
        return \Response::json($response);
    }

}
