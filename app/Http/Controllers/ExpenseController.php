<?php

namespace App\Http\Controllers;

use App\Models\Expense;
use App\Models\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    public function index()
    {
        $dataList = Expense::with('category')->get();
        return view('backend.expense.index', compact('dataList'));
    }

    public function create()
    {
    
        $categories = ExpenseCategory::all();
        return view('backend.expense.create',compact('categories'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'expense_for' => 'required',
            'amount' => 'required',
            'note' => 'required',
            'category_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        Expense::create([
            'date' => $request->date,
            'expense_for' => $request->expense_for,
            'amount' => $request->amount,
            'note' => $request->note,
            'category_id' => $request->category_id,
        ]);

        return redirect()->back()->with('success', 'Expense created successfully.');
    }

    public function edit($id)
    {
        $dataInfo = Expense::findOrFail($id);
        $categories = ExpenseCategory::all();
        return view('backend.expense.edit', compact('dataInfo','categories'));
    }

    public function update(Request $request)
    {
        $dataId=  $request->dataId;
        $customer = Expense::find($dataId);

        $validator = Validator::make($request->all(), [
            'date' => 'required',
            'expense_for' => 'required',
            'amount' => 'required',
            'note' => 'required',
            'category_id' => 'required',
        ]);
        
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        

        $customer->update([
            'date' => $request->date,
            'expense_for' => $request->expense_for,
            'amount' => $request->amount,
            'note' => $request->note,
            'category_id' => $request->category_id,
        ]);

        return redirect()->back()->with('success', 'Expense updated successfully.');
    }

    public function destroy($id)
    {
        Expense::destroy($id);
        return redirect()->route('expense.index')->with('success', 'Expense deleted successfully.');
    }

}
