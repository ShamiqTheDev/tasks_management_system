<?php

namespace App\Http\Controllers;

use App\Http\Requests\PermissionsRequest;
use Spatie\Permission\Models\Permission;

class PermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $permissions = Permission::orderby('id','DESC')->get();
        return view('admin.permissions.index', compact('permissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('permission.store');
        return view('admin.permissions.form', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PermissionsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PermissionsRequest $request, Permission $permission)
    {
        $created = Permission::create(['name' => $request->permission_name]);
        if ($created) {
            return redirect()->route('permissions')->with('success', 'Permission has been created');
        }
        return redirect()->back()->with('failure', 'There is an error in saving permission');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Permission $permission)
    {
        $action = route('permission.update', $permission->id);
        return view('admin.permissions.form', compact('permission', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PermissionsRequest $request, Permission $permission)
    {
        $permission->name = $request->permission_name;
        $saved = $permission->save();

        if ($saved) {
            return redirect()->route('permissions')->with('success', 'Permission has been updated successfully');
        }
        return redirect()->back()->with('failure', 'There is an error in saving permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $deleted = $permission->delete();
        if ($deleted) {
            return redirect()->route('permissions')->with('success','Permission has been deleted');
        }
        return redirect()->back()->with('failure', 'There is an error in deleting permission');
    }
}
