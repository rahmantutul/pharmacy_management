<?php

namespace App\Http\Controllers;

use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class VendorController extends Controller
{
    public function index()
    {
        $dataList = Vendor::get();
        return view('backend.vendor.index', compact('dataList'));
    }

    public function create()
    {
    
        return view('backend.vendor.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required',
            'payable' => 'required',
            'due' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        Vendor::create([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payable' => $request->payable,
            'due' => $request->due,
        ]);

        return redirect()->back()->with('success', 'Vendor created successfully.');
    }

    public function edit($id)
    {
        $dataInfo = Vendor::findOrFail($id);
        return view('backend.vendor.edit', compact('dataInfo'));
    }

    public function update(Request $request)
    {
        $dataId=  $request->dataId;
        $customer = Vendor::find($dataId);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'payable' => 'required',
            'due' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $customer->update([
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'payable' => $request->payable,
            'due' => $request->due,
        ]);

        return redirect()->back()->with('success', 'Vendor updated successfully.');
    }

    public function destroy($id)
    {
        Vendor::destroy($id);
        return redirect()->route('vendor.index')->with('success', 'Vendor deleted successfully.');
    }

}
