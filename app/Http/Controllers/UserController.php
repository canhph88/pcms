<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\User;
use App\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Input;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Excel\Entities\UsersExcel;

class UserController extends Controller
{
    /** @var UsersExcel */
    private $userxExcel;

    public function __construct()
    {
        $this->middleware('auth');
        $this->userxExcel = app()->make('UsersExcel');
    }

    public function messages()
    {
        $messages = array(
            'name.required' => 'Vui lòng nhập tên user',
            'username.required' => 'Vui lòng nhập username',
            'username.unique' => 'Username không được trùng',
            'email.required' => 'Vui lòng nhập email',
            'email.email' => 'Vui lòng nhập email hợp lệ',
            'email.unique' => 'Email không được trùng',
        );

        return $messages;
    }

    public function index(Request $request)
    {
        $users 	= User::where('active',1)
            ->doesntHave('roles')
            ->orWhereHas('roles', function ($query) {
                $query->where('name', '!=', 'admin');
            })
            ->orderBy('updated_at', 'desc')->paginate(15);

        return view('admin.user.index')->with('users',$users);
    }

    public function create(Request $request)
    {
        $user = new User();
        $roles = Role::where('name', '!=', 'admin')->get();

        return view('admin.user.create')->with('user', $user)->with('roles',$roles);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'bail|required|unique:users,username',
            'email' => 'bail|required|email|unique:users,email',
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $user =  new User();

        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = bcrypt('password');
        $user->phone = $request->phone;
        $user->address = $request->address;

        $user->save();

        $user->roles()->sync($request->roles);

        return redirect('/user')->with('message', 'store user successfully!');
    }

    public function show($user)
    {
        if ($user['active'] == 0) {
            abort(403);
        }
        return view('admin.user.show')->with('user', $user);
    }

    public function edit($user, Request $request)
    {
        if ($user->hasRole('admin') || $user['active'] == 0) {
            abort(403);
        }

        $roles = Role::where('name', '!=', 'admin')->get();

        return view('admin.user.edit')->with('user', $user)->with('roles',$roles);
    }

    public function update(Request $request, User $user)
    {
        $id = $request->get('id');

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'username' => 'required|unique:users,username,'.$id,
            'email' => 'bail|required|email|unique:users,email,'.$id,
        ], $this->messages());

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator->errors())->withInput();
        }

        $oldUser =  User::findOrNew($request->get('id'));

        $oldUser->name = $request->name;
        $oldUser->username = $request->username;
        $oldUser->email = $request->email;
        $oldUser->phone = $request->phone;
        $oldUser->address = $request->address;

        $oldUser->touch();

        $oldUser->save();

        if ($oldUser->hasRole('admin') == false) {
            $oldUser->roles()->sync($request->roles);
        }

        return redirect('/user')->with('message', 'update user successfully!');
    }

    public function destroy($user, Request $request)
    {
        $user['active'] = 0;
        $user -> save();

        return redirect('/user')->with('message', 'delete user successfully!');
    }

    public function destroyMultiple(Request $request)
    {
        $ids = $request->get('ids');

        DB::transaction(function () use ($ids) {
            foreach($ids as $id) {
                $user = User::find($id);
                $user['active'] = 0;
                $user -> save();
            }
        });

        return redirect('/user')->with('message', 'delete users successfully!');
    }

    public function export()
    {
        $this->userxExcel->export();
    }
}
