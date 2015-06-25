<?php

namespace DCN\Http\Controllers\Admin;


use DCN\Settings;
use Illuminate\Http\Request;
use DCN\Http\Requests;
use Response;
use DCN\Http\Requests\SettingsRequest;
use DCN\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function getAuth()
    {
        return view('backend.settings.auth');
    }
    public function postAuth(SettingsRequest $request)
    {
        try{
            foreach($request->only('publicSignup') as $key => $value){
                $setting = Settings::byKey($key);
                $setting->value = $value;
                $setting->save();
            }
            return Response::json(array(
                'success' => true,
            ));
        }
        catch(\Exception $e){
            return Response::json(array(
                'success' => false,
                'error'   => $e
            ));
        }
    }
}
