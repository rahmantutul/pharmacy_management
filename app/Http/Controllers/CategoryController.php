<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        return view('backend.category.index', ['dataList' => Category::paginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.category.create');
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

        $dataInfo = New Category();
        $dataInfo->name = $request->name;
        $dataInfo->save();
        return back()->with('success', 'Category Created Successfully!');
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // $dataInfo = Category::find($id);
        // return view('backend.category.edit',compact('dataInfo'));
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

        $dataInfo=Category::find($request->id);

        $dataInfo->name=$request->name;

        $dataInfo->save();

        return back()->with('success', 'Category Updated Successfully!');
          
    }
    public function destroy($id)
    {
        Category::where('id',$id)->delete();
         return redirect()->back()->with('success','Deleted Successfull');
    }
}
