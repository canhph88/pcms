<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Permission;
use App\Role;
use Input;

class RoleController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $roles 	= Role::all();

        return view('admin.role.index')->with('roles', $roles);
    }

    public function create(Request $request)
    {
        $role = new Role();
        $permissions = Permission::where('name', 'not like', 'role%')->get();

        return view('admin.role.create')->with('role', $role)->with('permissions', $permissions);
    }

    public function store(Request $request)
    {
        $role =  new Role();

        $role->name = $request->name;
        $role->display_name = $request->display_name;
        $role->description = $request->description;

        $role->save();

        $role->permissions()->sync($request->permissions);

        return redirect('/role')->with('message', 'store role successfully!');
    }

    public function edit($role, Request $request)
    {
        if ($role['name'] == 'admin') {
            abort(403);
        }

        $permissions = Permission::where('name', 'not like', 'role%')->get();

        return view('admin.role.edit')->with('role', $role)->with('permissions', $permissions);
    }

    public function update(Request $request, Role $role)
    {
        $oldRole =  Role::findOrNew($request->get('id'));

        $oldRole->name = $request->name;
        $oldRole->display_name = $request->display_name;
        $oldRole->description = $request->description;

        $oldRole->touch();

        $oldRole->save();

        if ($oldRole['name'] != 'admin') {
            $oldRole->permissions()->sync($request->permissions);
        }

        return redirect('/role')->with('message', 'update role successfully!');
    }

    public function destroy($role, Request $request)
    {
        $role -> delete();

        return redirect('/role')->with('message', 'delete role successfully!');
    }
}
