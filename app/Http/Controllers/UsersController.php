<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Hash;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderby('id','DESC')->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $action = route('user.store');
        $roles = Role::all();
        return view('admin.users.form', compact('action','roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\UsersRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        $user_saved = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);



        if ($user_saved) {
            $role = $request->has('user_role') ? $request->user_role: 'Employee';
            $user_saved->assignRole($role);
            return redirect()->route('users')->with('success', 'User has been created');
        }
        return redirect()->back()->with('failure', 'There is an error in saving user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $action = route('user.update', $user->id);
        $roles = Role::all();
        return view('admin.users.form', compact('action', 'roles', 'user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UsersRequest  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UsersRequest $request, User $user)
    {
        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->has('password')) {
            $user->password = Hash::make($request->password);
        }
        $user_saved = $user->save();

        if ($user_saved) {
            $role = 'Employee';

            if (!empty($request->user_role))
                $role = $request->user_role;

            $user->assignRole($role);

            return redirect()->route('users')->with('success', 'User has been saved successfully');
        }
        return redirect()->back()->with('failure', 'There is an error in saving permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $deleted = $user->delete();
        if ($deleted) {
            return redirect()->route('users')->with('success','User has been deleted');
        }
        return redirect()->back()->with('failure', 'There is an error in deleting user');
    }
}
