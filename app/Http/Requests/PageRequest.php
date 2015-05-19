<?php namespace DCN\Http\Requests;

use DCN\Http\Requests\Request;

class PageRequest extends Request {

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
                    'title'=>['required'],
                    'description'=>['required'],
                    'content'=>['required'],
                    'owner_id'=>['integer','exists:users,id'],
                    'system'=>['required'],
                    'status'=>['required','in:draft,review,published'],
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
                    'status'=>['required','in:draft,review,published'],
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
                    'status'=>['required','in:draft,review,published'],
                ];
            }
            default:break;
        }
	}

}
