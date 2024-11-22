<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class UserController extends Controller implements HasMiddleware
{

    public static function middleware(): array
{
    return [
        new Middleware('permission:view users', only: ['index']),
        new Middleware('permission:edit users', only: ['edit']),
        // new Middleware('permission:create users', only: ['create']),
        // new Middleware('permission:delete users', only: ['destroy']),
    ];
}

    public function index()
    {
        $users = User::latest()->paginate(10);
        // return view('users.list',['users=>$users']);

        return view('users.list', compact('users'));
    }



    public function edit($id)
    {
        $users = User::findOrFail($id); 
    $roles = Role::orderBy('name', 'asc')->get(); 
    $hasroles = $users->roles->pluck('id'); // Get the IDs of roles the user has

    return view('users.edit', compact('users', 'roles', 'hasroles'));

    }

    public function update(Request $request, $id)
    {
        $users  = User::findOrFail($id);
        $validator = Validator::make($request->all(), [

            'name' => 'required|min:3',
            'email' => 'required|email|unique:users,email,' . $id,',id',
            
        ]);

        if ($validator->fails()) {
            return redirect()->route('users.edit', $id)->withErrors($validator)->withInput();
        }
            
            $users->name = $request->name;
            $users->email = $request->email;
            $users->save;

            $roleNames = Role::whereIn('id', $request->role)->pluck('name')->toArray();
            $users->syncRoles($roleNames);

            // $users->syncRoles($request->role);
         

            return redirect()->route('users.index')->with('success', 'User updated successfully');
         }
                              

}
