<?php namespace DCN\Http\Requests;

use DCN\Http\Requests\Request;
use DCN\User;

class UserRequest extends Request
{

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
                    'name_first'=>[ 'required', 'min:2' ],
                    'name_last'=>[ 'required', 'min:2' ],
                    'username'=>[ 'required', 'unique:users' ],
                    'email'=>[ 'required', 'min:5', 'unique:users' ],
                    'password'=>[ 'required' ],
                    'password_confirmation'=>[ 'required_with:password', 'same:password' ],
                    'status'=>['in:registered,active,locked,banned'],
                    'status_ts'=>['required_if:status,locked','date','after:now'],
                    'roles'=>['array'],
                    'permission'=>['array'],
                ];
            }
            case 'PUT':
            {
                return [
                    'name_first'=>[ 'min:2' ],
                    'name_last'=>['min:2' ],
                    'username'=>['unique:users,username,'.$this->route()->user->id ],
                    'email'=>['min:5', 'unique:users,email,'.$this->route()->user->id ],
                    'password_confirmation'=>[ 'required_with:password', 'same:password' ],
                    'status'=>['in:registered,active,locked,banned'],
                    'status_ts'=>['required_if:status,locked','date','after:now'],
                    'roles'=>['array'],
                    'permission'=>['array'],
                ];
            }
            case 'PATCH':
            {
                return [
                    'name_first'=>[ 'min:2' ],
                    'name_last'=>[ 'min:2' ],
                    'username'=>[ 'unique:users,username,'.$this->route()->user->id ],
                    'email'=>[ 'min:5', 'unique:users,email,'.$this->route()->user->id ],
                    'password_confirmation'=>[ 'required_with:password', 'same:password' ],
                    'status'=>['in:registered,active,locked,banned'],
                    'status_ts'=>['required_if:status,locked','date','after:now'],
                    'roles'=>['array'],
                    'permission'=>['array'],
                ];
            }
            default:break;
        }
    }

}
