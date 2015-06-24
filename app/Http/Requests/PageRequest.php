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

        switch($this->method()) {
            case 'GET': return true;
            case 'DELETE': {
                if(Auth::user()->can('page.delete')) {
                    return true;
                }else{
                    return false;
                }
            }
            case 'POST': {
                if(Auth::user()->can('page.create')) {
                    return true;
                }else{
                    return false;
                }
            }
            case 'PUT': {
                if(Auth::user()->can('page.edit|page.publish|page.unpublish')) {
                    return true;
                }else{
                    return false;
                }
            }
            case 'PATCH': {
                if(Auth::user()->can('page.edit|page.publish|page.unpublish')) {
                    return true;
                }else{
                    return false;
                }
            }
            default: return false;
        }
    }

	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
        /**
         * Check What status values this user can submit
         */
        $status = [];
        if((!Auth::user()->can('page.unpublish') && ($this->route('page') != NULL && $this->route('page')->status == "published"))){
            $status[] = 'published';
        }else{
            if(Auth::user()->can('page.publish'))
                $status[] = 'published';
            if(Auth::user()->can('page.unpublish'))
                $status[] = 'unpublished';

            $status[] = 'draft';
            $status[] = 'review';
        }
        $status = implode(',',$status);

        /**
         * Check What System values this user can submit
         */
        if(Auth::user()->can('page.system'))
            $system = ["true","1",1];

        $system = array_merge($system,["false","0",0]);



        return [
            'title'=>['required'],
            'description'=>['required'],
            'content'=>['required'],
            'owner_id'=>['integer','exists:users,id'],
            'system'=>['required', 'boolean', 'in:'.$system],
            'status'=>['required','in:'.$status],
            'pageOrder' => ['required'],
        ];
	}

}
