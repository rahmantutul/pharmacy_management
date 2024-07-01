<?php

namespace App\Http\Controllers;

use App\Models\Leaf;
use Illuminate\Http\Request;

class LeafController extends Controller
{
    public function index()
    {
        return view('backend.Leaf.index', ['dataList' => Leaf::paginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.Leaf.create');
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

        $dataInfo = New Leaf();
        $dataInfo->name = $request->name;
        $dataInfo->qty=$request->qty;
        $dataInfo->save();
        return back()->with('success', 'Leaf Created Successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $dataInfo = Leaf::find($id);
        // return view('backend.Leaf.edit',compact('dataInfo'));
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
        'qty' => 'required',
        ]);

        $dataInfo=Leaf::find($request->id);

        $dataInfo->name=$request->name;
        $dataInfo->qty=$request->qty;

        $dataInfo->save();

        return back()->with('success', 'Leaf Updated Successfully!');
          
    }
    public function destroy($id)
    {
        Leaf::where('id',$id)->delete();
         return redirect()->back()->with('success','Deleted Successfull');
    }
}
