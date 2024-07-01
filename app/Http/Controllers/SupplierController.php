<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Supplier;
use Illuminate\Support\Facades\Validator;

class SupplierController extends Controller
{
    public function index()
    {
        $dataList = Supplier::get();
        return view('backend.supplier.index', compact('dataList'));
    }

    public function create()
    {
    
        return view('backend.supplier.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required',
            'payable' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        Supplier::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payable' => $request->payable,
        ]);

        return redirect()->back()->with('success', 'Supplier created successfully.');
    }

    public function edit($id)
    {
        $dataInfo = Supplier::findOrFail($id);
        return view('backend.supplier.edit', compact('dataInfo'));
    }

    public function update(Request $request)
    {
        $dataId=  $request->dataId;
        $customer = Supplier::find($dataId);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'payable' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payable' => $request->payable,
        ]);

        return redirect()->back()->with('success', 'Supplier updated successfully.');
    }

    public function destroy($id)
    {
        Supplier::destroy($id);
        return redirect()->route('supplier.index')->with('success', 'Supplier deleted successfully.');
    }
    public function view($id)
    {
        $dataInfo = supplier::findOrFail($id);
        return view('backend.supplier.view', compact('dataInfo'));
    }
}
