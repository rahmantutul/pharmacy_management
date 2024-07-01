<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('backend.role.index', ['roles' => Role::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.role.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = New Role();
        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->save();
        return back()->with('success', 'Role Created Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dataInfo = Role::find($id);
        $permission = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all();
        return view('backend.role.edit',compact('dataInfo','permission','rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
           $request->validate([
               'name' => 'required',
           ]);

           $dataInfo=Role::find($request->id);

           $dataInfo->name=$request->name;
           $dataInfo->save();
           return back()->with('success','Role Updated Successfully!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
          Role::where('id',$id)->delete();
        }catch (\Exception $e){
          return redirect()->back()->with('error',$e->getMessage());
        }
        return redirect()->back()->with('success','Deleted Successfull');

    }

    public function access_index($id)
    {
      $permission_list =  Permission::all();
      $group = Permission::distinct()->get();

      $generalscontroller = new GeneralsController();
      $role_name = $generalscontroller->RoleName($id);

      $roles = Role::with('permissions')
              ->where('id', $id)->first();

      return view ('backend.role.assign-permission',
          compact('permission_list','id','role_name','group','roles'));
    }

    public function access_store(Request $request)
    {
        $request->validate([
            'permissions' => 'required',
        ]);
        $id = $request->id;
        $role = Role::findOrFail($id);
        $role->syncPermissions($request->permissions);
        return back()->with('succeess','Role has been Mapped successfully');
    }
}
