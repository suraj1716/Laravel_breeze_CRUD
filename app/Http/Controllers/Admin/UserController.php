<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use App\Models\Admin;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $users = Admin::paginate(5);

        return view('admin.users.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles=Role::all();
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
           'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:6',
        'roles' => 'required|array',
        'roles.*' => 'exists:roles,name',
        ]);

        $user= Admin::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password)
        ]);

        $user->assignRole($request->roles);


        return redirect()->route('admin.users.index')->with('success', 'Admin created successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $roles=Role::all();
          $user = Admin::find($id);
        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Admin $user)
    {
        // Validation rules
        $request->validate([
            'name' => 'required',
            'email' => ['required', Rule::unique('users')->ignore($user->id)],
            'password' => 'required|min:8',
        ]);

        // Update the user details
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Sync the roles: Ensure roles are passed as an array of role names, not IDs
        $roles = $request->roles; // Assuming roles are passed as names, not IDs
        $user->syncRoles($roles);

        // Redirect back with a success message
        return redirect()->route('admin.users.index')->with('success', 'Admin updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Admin $user)
    {
        // if (Auth::user()->id == $user->id) {
        //     return redirect()->route('users.index')->with('error', 'You cannot delete your own account.');
        // }
        $user->delete();
        return redirect()->route('admin.users.index')->with('status', 'user Deleted successfully');

    }
}
