<?php

namespace App\Http\Controllers;

use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        return view('backend.type.index', ['dataList' => Type::paginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.type.create');
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
        'name' => 'required|unique:types,name',
        ]);

        $dataInfo = New Type();
        $dataInfo->name = $request->name;
        $dataInfo->save();
        return back()->with('success', 'Type Created Successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $dataInfo = Type::find($id);
        // return view('backend.type.edit',compact('dataInfo'));
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
        'name' => 'required|unique:types,name,'.$request->id,
        ]);

        $dataInfo=Type::find($request->id);

        $dataInfo->name=$request->name;

        $dataInfo->save();

        return back()->with('success', 'Type Updated Successfully!');
          
    }
    public function destroy($id)
    {
        Type::where('id',$id)->delete();
         return redirect()->back()->with('success','Deleted Successfull');
    }
}
