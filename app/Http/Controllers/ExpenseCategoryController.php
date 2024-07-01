<?php

namespace App\Http\Controllers;

use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseCategoryController extends Controller
{
    public function index()
    {
        $dataList = ExpenseCategory::get();
        return view('backend.expenseCategory.index', compact('dataList'));
    }

    public function create()
    {
    
        return view('backend.expenseCategory.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required',
            'description' => 'string|max:255',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        ExpenseCategory::create([
            'name' => $request->name,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Category created successfully.');
    }

    public function edit($id)
    {
        $dataInfo = ExpenseCategory::findOrFail($id);
        return view('backend.expenseCategory.edit', compact('dataInfo'));
    }

    public function update(Request $request)
    {
        $dataId=  $request->dataId;
        $customer = ExpenseCategory::find($dataId);

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'status' => 'required',
            'description' => 'string|max:255',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        

        $customer->update([
            'name' => $request->name,
            'status' => $request->status,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Category updated successfully.');
    }

    public function destroy($id)
    {
        ExpenseCategory::destroy($id);
        return redirect()->route('ecategory.index')->with('success', 'Category deleted successfully.');
    }

}
