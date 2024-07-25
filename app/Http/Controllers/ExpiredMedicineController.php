<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Medicine;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ExpiredMedicineController extends Controller
{

    public function index()
    {
        $suppliers = Supplier::get();
        $categories = Category::get();
        $dataList = Stock::with('medicine','medicine.supplier')
                             ->where('expire_date', '<', date('Y-m-d'))
                             ->select('medicineId','expire_date', DB::raw('SUM(qty) as total_qty'))
                             ->groupBy('expire_date')
                             ->groupBy('medicineId')
                             ->paginate(50);
                            //  dd($dataList);
        return view('backend.expired.index', compact('dataList','suppliers','categories'));

    }
}
