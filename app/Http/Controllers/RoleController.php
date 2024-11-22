<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view roles', only: ['index']),
            new Middleware('permission:edit roles', only: ['edit']),
            new Middleware('permission:create roles', only: ['create']),
            new Middleware('permission:delete roles', only: ['destroy']),
        ];
    }

    public function index()
    {
        $roles = Role::orderBy('name', 'asc')->get();
        // return $roles;

        return view('roles.list',['roles'=>$roles]);
    }

    public function create()
    {
        $permissions = Permission::orderBy('name', 'asc')->get();
            // return $permissions;

        return view('roles.create',['permissions'=>$permissions]);
    }

    public  function store(Request $request)
    {
        // dd($request->all());
        $valdator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        if ($valdator->fails()) {
            return redirect()->back()->withErrors($valdator)->withInput();
        }else{
            $role = Role::create(['name' => $request->name]);
            
            if (!empty($request->permission)){
                foreach ($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }
            return redirect()->route('roles.index')->with('success', 'Role created successfully.');
        }
    }

    public  function edit($id)
    {
        $role = Role::findOrFail($id);
        $haspermission = $role->permissions->pluck('name'); 
        $permissions = Permission::orderBy('name', 'asc')->get();
        return view('roles.edit',
        ['role'=>$role,
        'permissions'=>$permissions,
        'haspermission'=>$haspermission]);
    }   
    public function update(Request $request, $id)
    {
        $role = Role::findOrFail($id);
    
        // Validate the request
        $validate = Validator::make($request->all(), [
            'name' => 'required|unique:roles,name,' . $id,
        ]);
    
        if ($validate->passes()) {
            // Update the role name
            $role->name = $request->name;
            $role->save();
    
            // Sync permissions
            if (!empty($request->permissions)) {
                // Retrieve permission names based on IDs
                $permissions = Permission::whereIn('id', $request->permissions)->pluck('name')->toArray();
                $role->syncPermissions($permissions);
            } else {
                $role->syncPermissions([]); // Clear all permissions if none are selected
            }
    
            // Redirect with success message
            return redirect()->route('roles.index')->with('success', 'Role updated successfully.');
        } else {
            // Redirect back with validation errors
            return redirect()->route('roles.edit', $id)
                             ->withErrors($validate)
                             ->withInput();
        }
    }
    

    public  function destroy($id)
    {  
        $role = Role::findOrFail($id);
        $role->delete();
        
        return redirect()->route('roles.index')->with('success', 'Role deleted successfully.');
    }
}
