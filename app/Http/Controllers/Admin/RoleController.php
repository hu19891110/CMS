<?php namespace DCN\Http\Controllers\Admin;

use DCN\Role;
use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use Illuminate\Http\Request;

class RoleController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        //Display Latest User Actions Etc.
        $history = Role::classRevisionHistory();
        return view('backend.role.index',compact('history'));
    }
    public function getCreate()
    {
        return view('backend.role.create');
    }
    public function getList()
    {
        //Display Latest User Actions Etc.wat
        $roles = Role::paginate(10);
        return view('backend.role.list',compact('roles'));
    }
    public function getEdit(Role $role)
    {
        return view('backend.role.edit',compact('role'));
    }
}