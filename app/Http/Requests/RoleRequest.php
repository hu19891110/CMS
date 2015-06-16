<?php namespace DCN\Http\Requests;

use DCN\Http\Requests\Request;

class RoleRequest extends Request {

	/**
	 * Determine if the user is authorized to make this request.
	 *
	 * @return bool
	 */
	public function authorize()
	{
        if(Auth::user()->is('user.admin') || Auth::user()->can('user.roles'))
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
                    'name'=>['required'],
                    'slug'=>['unique:roles,slug'],
                    'description'=>['required'],
                    'level'=>['integer','max:1000000000'],
                    'permission'=>'array',
                ];
            }
            case 'PUT':
            {
                return [
                    'name'=>['required'],
                    'slug'=>['unique:roles,slug,'.$this->route()->role->id],
                    'description'=>['required'],
                    'level'=>['integer','max:1000000000'],
                    'permission'=>'array',
                ];
            }
            case 'PATCH':
            {
                return [
                    'name'=>['required'],
                    'slug'=>['unique:roles,slug,'.$this->route()->role->id],
                    'description'=>['required'],
                    'level'=>['integer','max:1000000000'],
                    'permission'=>'array',
                ];
            }
            default:break;
        }
	}

}
