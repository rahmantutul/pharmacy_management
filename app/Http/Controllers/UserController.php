<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    
    
    public function index()
    {
        $dataList = User::with('roles')->get();
        return view('backend.users.index', compact('dataList'));
    }

    public function create()
    {
        
        $roleList = Role::all();
        return view('backend.users.create', compact('roleList'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|confirmed|min:8',
            'roleId' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $user=User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->syncRoles($request->roleId);

        return redirect()->back()->with('success', 'User created successfully.');
    }

    public function edit($id)
    {
        $dataInfo = User::with('roles')->findOrFail($id);
        $roleList = Role::all();
        return view('backend.users.edit', compact('dataInfo','roleList'));
    }

    public function update(Request $request)
    {
        $dataId=  $request->dataId;
        $user = User::find($dataId);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id,
            'new_password' => 'nullable|string|min:8',
            'roleId' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if($request->current_password){
            if (!Hash::check($request->current_password, $user->password)) {
                return redirect()->back()->withErrors(['current_password' => 'The current password is incorrect.'])->withInput();
            }
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->new_password ? Hash::make($request->new_password) : $user->password,
        ]);

        $user->syncRoles($request->roleId);

        return redirect()->back()->with('success', 'User updated successfully.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }

}
