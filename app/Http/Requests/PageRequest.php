<?php namespace DCN\Http\Requests;

use Auth;
use DCN\Http\Requests\Request;

class PageRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{

        if(Auth::user()->is('page.admin') || Auth::user()->can('page.*'))
		    return true;
        else
            return false;
	}

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        switch($this->method())
        {
            case 'GET':
            case 'DELETE':
            {
                return [];
            }
            case 'POST':
            {
                return [
                    'title'=>['required'],
                    'description'=>['required'],
                    'content'=>['required'],
                    'owner_id'=>['integer','exists:users,id'],
                    'system'=>['required'],
                    'status'=>['required','in:draft,review,unpublished,published'],
                ];
            }
            case 'PUT':
            {
                return [
                    'title'=>['required'],
                    'description'=>['required'],
                    'content'=>['required'],
                    'owner_id'=>['integer','exists:users,id'],
                    'system'=>['required'],
                    'status'=>['required','in:draft,review,unpublished,published'],
                ];
            }
            case 'PATCH':
            {
                return [
                    'title'=>['required'],
                    'description'=>['required'],
                    'content'=>['required'],
                    'owner_id'=>['integer','exists:users,id'],
                    'system'=>['required'],
                    'status'=>['required','in:draft,review,unpublished,published'],
                ];
            }
            default:break;
        }
	}

}
