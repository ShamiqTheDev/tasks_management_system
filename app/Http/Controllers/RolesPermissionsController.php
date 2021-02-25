<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesPermissionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role)
    {
        $action = route('role.permission.update', $role->id);
        $permissions = Permission::orderby('id','DESC')->get();
        return view('admin.roles.permissions', compact('role','permissions','action'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Spatie\Permission\Models\Role $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        foreach ($role->permissions as $permission) {
            $role->revokePermissionTo($permission->name);
        }
        $permissions_set = $role->givePermissionTo($request->permissions);
        if ($permissions_set) {
            return redirect()->route('roles.permissions', $role->id)->with('success', "Permission has been saved for role {$role->name}");
        }
        return redirect()->back()->with('failure', 'There is an error in saving permission');
    }

}
