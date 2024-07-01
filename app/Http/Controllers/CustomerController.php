<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CustomerController extends Controller
{
    public function index()
    {
        $dataList = Customer::get();
        return view('backend.customer.index', compact('dataList'));
    }

    public function create()
    {
    
        return view('backend.customer.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'balance' => $request->balance,
        ]);

        return redirect()->back()->with('success', 'Customer created successfully.');
    }

    public function edit($id)
    {
        $dataInfo = Customer::findOrFail($id);
        return view('backend.customer.edit', compact('dataInfo'));
    }

    public function update(Request $request)
    {
        $dataId=  $request->dataId;
        $customer = Customer::find($dataId);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'phone' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $customer->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'balance' => $request->balance,
        ]);

        return redirect()->back()->with('success', 'Customer updated successfully.');
    }

    public function destroy($id)
    {
        Customer::destroy($id);
        return redirect()->route('customer.index')->with('success', 'Customer deleted successfully.');
    }
    public function view($id)
    {
        $dataInfo = Customer::findOrFail($id);
        return view('backend.customer.view', compact('dataInfo'));
    }

}
