<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;

class PermissionController extends Controller
{
    public function index()
    {
        return view('backend.permission.index', ['dataList' => Permission::paginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.permission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    { 
        $request->validate([
        'name' => 'required|unique:permissions,name',
        ]);

        $role = New Permission();
        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->save();
        return back()->with('success', 'Permission Created Successfully!');
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
        // $dataInfo = Permission::find($id);
        // return view('backend.permission.edit',compact('dataInfo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $request->validate([
        'name' => 'required|unique:permissions,name,'.$request->id,
        ]);

        $dataInfo=Permission::find($request->id);

        $dataInfo->name=$request->name;

        $dataInfo->save();

        return back()->with('success', 'Role Updated Successfully!');
          
    }
    public function destroy($id)
    {
        Permission::where('id',$id)->delete();
         return redirect()->back()->with('success','Deleted Successfull');
    }

}
