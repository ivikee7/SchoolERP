<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Spatie\Permission\Models\Permission;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Permission $permission)
    {
        if (Auth()->user()->can('permission_access')) {
            if ($request->ajax()) {
                $permissions = $permission::get();

                return DataTables($permissions)
                    ->editColumn('name', function ($permissions) {
                        $span = '<span class="bg-cyan rounded d-inline-flex m-1 p-1 ">'.$permissions->name.'</span>';

                        return $span;
                    })
                    ->addColumn('action', function ($permissions) {
                        $btn = '<a href="'.route('permission.edit', $permissions->id).'" class="mx-auto bg-warning m-1 p-1 rounded"> <i class="far fa-pen"></i> Edit</a>';

                        return $btn;
                    })
                    ->rawColumns(['name', 'action'])
                    ->make(true);
            }

            return view('permission.index');
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
        if (Auth()->user()->can('permission_create')) {
            return view('permission.create');
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
        if (Auth()->user()->can('permission_create')) {
            $request->validate([
                'permission_name' => 'required|string',
            ]);
            Permission::findOrCreate($request->permission_name, 'web');

            return Redirect::route('permission.index');
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
        if (Auth()->user()->can('permission_edit')) {
            $permission = Permission::findById($id);

            return view('permission.edit')->with(['permission' => $permission]);
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
        if (Auth()->user()->can('permission_edit')) {
            $request->validate([
                'permission_name' => 'required:string',
            ]);
            $permission = Permission::findById($id);
            $permission->name = $request->permission_name;
            $permission->guard_name = 'web';
            $permission->save();

            return Redirect::route('permission.index');
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
