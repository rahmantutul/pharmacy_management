<?php

namespace App\Http\Controllers;

use App\Models\PaymenMethod;
use Illuminate\Http\Request;

class PaymentMethodController extends Controller
{
    public function index()
    {
        return view('backend.payment.index', ['dataList' => PaymenMethod::paginate(50)]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.payment.create');
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
        'name' => 'required|unique:paymen_methods,name',
        'balance' => 'required',
        ]);

        $dataInfo = New PaymenMethod();
        $dataInfo->name = $request->name;
        $dataInfo->balance=$request->balance;
        $dataInfo->save();
        return back()->with('success', 'Paymen Method Created Successfully!');
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
        'name' => 'required|unique:paymen_methods,name,'.$request->id,
        'balance' => 'required',
        ]);

        $dataInfo=PaymenMethod::find($request->id);

        $dataInfo->name=$request->name;
        $dataInfo->balance=$request->balance;

        $dataInfo->save();

        return back()->with('success', 'Paymen Method Updated Successfully!');
          
    }
    public function destroy($id)
    {
        PaymenMethod::where('id',$id)->delete();
         return redirect()->back()->with('success','Deleted Successfull');
    }
}
