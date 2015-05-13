<?php namespace DCN\Http\Requests;

use DCN\Http\Requests\Request;

class LoginRequest extends Request {

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
        return [
            'username'=>['required_without:email','exists:users,username'],
            'email'=>['required_without:username','exists:users,email'],
            'password'=>'required'
        ];
    }

    public function all(){
        $data = parent::all();
        $data['status'] = 'active';
        return $data;
    }

}
