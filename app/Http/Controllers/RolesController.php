<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use App\Http\Requests\RolesRequest;
use Spatie\Permission\Models\Role;



class RolesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::orderby('id','DESC')->get();
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('role.store');
        return view('admin.roles.form', compact('action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\RolesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RolesRequest $request)
    {
        $created = Role::create(['name' => $request->role_name]);
        if ($created) {
            return redirect()->route('roles')->with('success', 'Role has been created');
        }
        return redirect()->back()->with('failure', 'There is an error in saving role');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $action = route('role.update', $role->id);
        return view('admin.roles.form', compact('role', 'action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\RolesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RolesRequest $request, Role $role)
    {
        $role->name = $request->role_name;
        $saved = $role->save();

        if ($saved) {
            return redirect()->route('roles')->with('success', 'Role has been updated successfully');
        }
        return redirect()->back()->with('failure', 'There is an error in saving role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Spatie\Permission\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $deleted = $role->delete();
        if ($deleted) {
            return redirect()->route('roles')->with('success','Role has been deleted');
        }
        return redirect()->back()->with('failure', 'There is an error in deleting role');
    }
}
