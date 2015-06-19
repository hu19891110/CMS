<?php

namespace DCN\Http\Requests;

use DCN\Http\Requests\Request;
use Auth;

class SettingsRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if(Auth::user()->is('admin.settings') || Auth::user()->can('settings.*'))
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
        return [
            'publicSignup'=>['integer','in:1,0'],
        ];
    }
}
