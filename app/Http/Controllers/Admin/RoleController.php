<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Traits\HasRoles;

class RoleController extends Controller
{

    //  public function __construct()
    //  {
    //      // examples:
    //      $this->middleware(['permission:role-list |role-create|role-edit|role-delete'],["only"=>["index","show"]]);
    //      $this->middleware(['permission:role-create'],["only"=>["create","store"]]);
    //      $this->middleware(['permission:role-edit'],["only"=>["edit","update"]]);
    //      $this->middleware(['permission:role-delete'],["only"=>["destroy"]]);


    //  }


    public function index()
    {
        $roles = Role::paginate(5);
        return view('admin.roles.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::all();
        return view('admin.roles.create', compact('permissions'));
        dd($request->permissions, $role);


    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|string|max:255',

        ]);

        $role = Role::create([
            'name' => $request->name,
            'guard_name' => 'admin', // You might want to change this field's name based on your requirements
        ]);

        // Sync permissions with the role
        $role->syncPermissions($request->permissions);

        return redirect()->route('admin.roles.index')->with('success', 'Role created successfully');
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
        $role = Role::find($id);
        $permissions=Permission::all();

        return view('admin.roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $role = Role::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'permissions' => 'required|array', // Ensure permissions is an array
            'permissions.*' => 'exists:permissions,name', // Validate that the permissions exist
        ]);

        $role->update([
            'name' => $request->name,
            'guard_name' => 'admin', // Update the name field
        ]);

        if ($request->has('permissions')) {
            $role->syncPermissions($request->permissions);
        }
        return redirect()->route('admin.roles.index')->with('success', 'Role updated successfully');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $role = Role::findOrFail($id);

    // Delete the role
    $role->delete();

    // Redirect back with a success message
    return redirect()->route('admin.roles.index')->with('success', 'Role deleted successfully');
    }
}
