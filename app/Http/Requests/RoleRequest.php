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
		return true;
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
                    'level'=>['integer','max:999999999','min:2']
                ];
            }
            case 'PUT':
            {
                return [
                    'name'=>['required'],
                    'slug'=>['unique:roles,slug,'.$this->route()->role->id],
                    'description'=>['required'],
                    'level'=>['integer','max:999999999','min:2']
                ];
            }
            case 'PATCH':
            {
                return [
                    'name'=>['required'],
                    'slug'=>['unique:roles,slug,'.$this->route()->role->id],
                    'description'=>['required'],
                    'level'=>['integer','max:999999999','min:2']
                ];
            }
            default:break;
        }
	}

}
