<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Unit;

class UnitController extends Controller
{
    public function index()
    {
        return view('backend.unit.index', ['dataList' => Unit::paginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.unit.create');
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
        'name' => 'required|unique:categories,name',
        ]);

        $role = New Unit();
        $role->name = $request->name;
        $role->save();
        return back()->with('success', 'Unit Created Successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $dataInfo = Unit::find($id);
        // return view('backend.unit.edit',compact('dataInfo'));
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
        'name' => 'required|unique:categories,name,'.$request->id,
        ]);

        $dataInfo=Unit::find($request->id);

        $dataInfo->name=$request->name;

        $dataInfo->save();

        return back()->with('success', 'Unit Updated Successfully!');
          
    }
    public function destroy($id)
    {
        Unit::where('id',$id)->delete();
         return redirect()->back()->with('success','Deleted Successfull');
    }
}
