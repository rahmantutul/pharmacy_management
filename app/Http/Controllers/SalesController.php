<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Medicine;
use App\Models\PaymenMethod;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    //
    public function create(){
        $month = date('m');
        $day = date('d');
        $year = date('Y');

        $lastData=Purchase::latest()->first();
        if($lastData){
            $number = $lastData->id;
        }else{
            $number = 1;
        }

        $today = $year . '-' . $month . '-' . $day;
        $invoice = 'INV'.$year . $month.str_pad($number, 4,'0',STR_PAD_LEFT);
        $medicines = Medicine::all();
        $methods = PaymenMethod::all();
        $suppliers= Supplier::get();
        $categories= Category::get();
        $medicines= Medicine::paginate(60);
        return view('backend.sales.create',compact('suppliers','today','invoice','medicines','methods','categories','medicines'));
    }

    public function filter(Request $request)
    {
        $query = Medicine::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('supplier')) {
            $query->where('supplierId', $request->supplier);
        }

        if ($request->filled('category')) {
            $query->where('categoryId', $request->category);
        }

        $medicines = $query->paginate(60);

        return view('backend.sales.search-result', compact('medicines'))->render();
    }

    public function addToCart(Request $request){
        return $request->medicineId;
    }
}
