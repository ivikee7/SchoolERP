<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Role $role)
    {
        if (Auth()->user()->can('role_access')) {
            if ($request->ajax()) {
                $roles = $role::get();
                //            $permissions = $role->permissions->pluck('name');
                return DataTables($roles)
                    ->addColumn('permissions', function ($roles) {
                        $permissions_array = $roles->permissions->pluck('name');
                        $span = '';
                        foreach ($permissions_array as $permission) {
                            $span .= '<span class="bg-success rounded-pill d-inline-flex mb-1  pl-2 pr-2">'.$permission.'</span> ';
                        }

                        return $span;
                    })
                    ->addColumn('action', function ($roles) {
                        $btn = '<a href="'.route('role.edit', $roles->id).'" class="mx-auto bg-warning m-1 p-1 rounded"> <i class="far fa-pen"></i> Edit</a>';

                        return $btn;
                    })
                    ->rawColumns(['permissions', 'action'])
                    ->make(true);
            }

            return view('role.index');
        } else {
            return abort(404);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth()->user()->can('role_edit')) {
            $permissions = Permission::all()->pluck('name');

            return view('role.create')->with(['permissions' => $permissions]);
        } else {
            return abort(404);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth()->user()->can('role_create')) {
            $request->validate([
                'role_name' => 'required|string',
            ]);
            $role = Role::findOrCreate($request->role_name, 'web');
            $role->syncPermissions($request->permissions);

            return Redirect::route('role.index');
        } else {
            return abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth()->user()->can('role_edit')) {
            $role = Role::findById($id);
            $permissions = Permission::all()->pluck('name');
            $roleHasPermissions = $role->permissions->pluck('name');

            return view('role.edit')->with(['role' => $role, 'permissions' => $permissions, 'roleHasPermissions' => $roleHasPermissions]);
        } else {
            return abort(404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (Auth()->user()->can('role_edit')) {
            $role = Role::findById($id);
            $role->name = $request->role_name;
            $role->guard_name = $request->guard_name;
            $role->syncPermissions($request->permissions);

            return Redirect::route('role.index');
        } else {
            return abort(404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }
}
