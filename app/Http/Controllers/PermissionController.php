<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use  Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission; // Correct import for the Permission model
use Illuminate\Routing\Controllers\Middleware;
use Illuminate\Routing\Controllers\HasMiddleware;


class PermissionController extends Controller implements HasMiddleware
{

    public static function middleware(): array
    {
        return [
            new Middleware('permission:view permissions', only: ['index']),
            new Middleware('permission:edit permissions', only: ['edit']),
            new Middleware('permission:create permissions', only: ['create']),
            new Middleware('permission:delete permissions', only: ['destroy']),
        ];
    }
    //basically permission
    public function index()
    {
        // Fetch permissions ordered by creation date (newest first), paginated
        $permissions = Permission::orderBy('created_at', 'desc')->paginate(10);
    
        // Pass the permissions data to the view
        return view('permissions.list', ['permissions' => $permissions]);
    }
    
    public function create()
    {
        return view('permissions.create');
        
    }   

    public function store(Request $request)
    {
        // Validate the incoming data
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255|unique:permissions,name',
        ]);
    
        if ($validator->fails()) {
            // Redirect back with errors if validation fails
            return redirect()->back()->withErrors($validator)->withInput();
        }
    
        // Save the permission using Spatie's Permission package
        Permission::create(['name' => $request->name]);
    
        // Redirect to a specific page with a success message
        return redirect()->route('permissions.index')->with('success', 'Permission created successfully.');
    }
    
    public function edit($id)
    {
        $permissions = Permission::findOrFail($id);
        // return $permissions;
        return view('permissions.edit', compact('permissions'));
    }
    public function update(Request $request, $id)
    {
        $permissions = Permission::findOrFail($id);
        // also add validate 
        $validater = Validator::make($request->all(), [
            'name' => 'required|string|max:255,name',    
        ]);
        if ($validater->fails()) {
            return redirect()->back()->withErrors($validater)->withInput();
        }else{
        $permissions->name = $request->name;
        $permissions->save();
        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully.');
        }
    }   
    public function destroy($id)
    {
        $permissions = Permission::findOrFail($id);
        $permissions->delete();
        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully.');
        
    }
}
