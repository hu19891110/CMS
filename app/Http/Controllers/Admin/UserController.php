<?php namespace DCN\Http\Controllers\Admin;

use Crypt;
use DCN\Http\Requests;
use DCN\Http\Controllers\Controller;

use DCN\Role;
use DCN\User;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function getIndex()
    {
        //Display Latest User Actions Etc.
        $history = User::classRevisionHistory();
        return view('backend.user.index',compact('history'));
    }
    public function getCreate()
    {
        $roles = Role::all()->groupBy('level');
        return view('backend.user.create',compact('roles'));
    }
    public function getList()
    {
        //Display Latest User Actions Etc.wat
        $users = User::with('roles')->paginate(10);
        return view('backend.user.list',compact('users'));
    }
    public function getEdit(User $user)
    {
        $roles = Role::all()->groupBy('level');
        return view('backend.user.edit',compact('user','roles'));
    }
}
