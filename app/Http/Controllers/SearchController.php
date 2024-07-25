<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\ExpenseCategory;
use App\Models\Leaf;
use App\Models\Medicine;
use App\Models\PaymenMethod;
use App\Models\Permission;
use App\Models\Role;
use App\Models\Stock;
use App\Models\Supplier;
use App\Models\Type;
use App\Models\Unit;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function filterUsers(Request $request)
    {
        $query = User::query();

    if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
    }
    if ($request->filled('email')) {
        $query->where('email', 'like', '%' . $request->email . '%');
    }

    $dataList = $query->with('roles')->paginate(24);

    return response()->json([
        'data' => $dataList->items(),
        'links' => (string) $dataList->links()
    ]);
    }
    
    public function filterRole(Request $request)
    {
        $query = Role::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $roles = $query->paginate(50);

        return response()->json([
            'data' => $roles->items(),
            'links' => (string) $roles->links("pagination::bootstrap-4")
        ]);
    }
    public function filterPermission(Request $request)
    {
        $query = Permission::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $permissions = $query->paginate(50);

        return response()->json([
            'data' => $permissions->items(),
            'links' => (string) $permissions->links("pagination::bootstrap-4")
        ]);
    }

    public function filterCustomers(Request $request)
    {
        $query = Customer::query();

        if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        $customers = $query->paginate(50);

        return response()->json([
            'data' => $customers->items(),
            'links' => (string) $customers->links("pagination::bootstrap-4")
        ]);
    }
    public function filterExpenseCategories(Request $request)
    {
        $query = ExpenseCategory::query();

        if ($request->filled('name')) {
          $query->where('name', 'like', '%' . $request->name . '%');
        }

        $expenseCategory = $query->paginate(50);

        return response()->json([
            'data' => $expenseCategory->items(),
            'links' => (string) $expenseCategory->links("pagination::bootstrap-4")
        ]);
    }

    public function filterExpenses(Request $request)
    {
        // dd($request->all());
       // Fetch expenses with optional filters
       $query = Expense::with('category');

       // Apply filters if provided
       if ($request->filled('fromDate') && $request->filled('toDate')) {
           $query->whereBetween(DB::raw('DATE(date)'), [$request->fromDate, $request->toDate]);
       }

       if ($request->filled('categoryId')) {
           $query->where('category_id', $request->categoryId);
       }

       if ($request->filled('expenseFor')) {
           $query->where('expense_for', 'like', '%' . $request->expenseFor . '%');
       }

       // Paginate the filtered results
       $dataList = $query->paginate(50); // Adjust per page count as needed

       return response()->json([
        'data' => $dataList->items(),
        'links' => (string) $dataList->links("pagination::bootstrap-4")
    ]);
    }

    public function filterSuppliers(Request $request)
    {
        $query = Supplier::query();

        if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        $suppliers = $query->paginate(50);

        return response()->json([
            'data' => $suppliers->items(),
            'links' => (string) $suppliers->links("pagination::bootstrap-4")
        ]);
    }
    public function filterVendor(Request $request)
    {
        $query = Vendor::query();

        if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->filled('phone')) {
            $query->where('phone', 'like', '%' . $request->phone . '%');
        }

        $vendors = $query->paginate(50);

        return response()->json([
            'data' => $vendors->items(),
            'links' => (string) $vendors->links("pagination::bootstrap-4")
        ]);
    }
    public function filterCategory(Request $request)
    {
        $query = Category::query();

        if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
        }

        $vendors = $query->paginate(50);

        return response()->json([
            'data' => $vendors->items(),
            'links' => (string) $vendors->links("pagination::bootstrap-4")
        ]);
    }
    public function filterUnit(Request $request)
    {
        $query = Unit::query();

        if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
        }

        $vendors = $query->paginate(50);

        return response()->json([
            'data' => $vendors->items(),
            'links' => (string) $vendors->links("pagination::bootstrap-4")
        ]);
    }
    public function filterLeaf(Request $request)
    {
        $query = Leaf::query();

        if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
        }

        $leaves = $query->paginate(50);

        return response()->json([
            'data' => $leaves->items(),
            'links' => (string) $leaves->links("pagination::bootstrap-4")
        ]);
    }
    public function filterType(Request $request)
    {
        $query = Type::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        $types = $query->paginate(50);

        return response()->json([
            'data' => $types->items(),
            'links' => (string) $types->links("pagination::bootstrap-4")
        ]);
    }
    public function filterMethod(Request $request)
    {
        $query = PaymenMethod::query();

        if ($request->filled('name')) {
        $query->where('name', 'like', '%' . $request->name . '%');
        }

        $methods = $query->paginate(50);

        return response()->json([
            'data' => $methods->items(),
            'links' => (string) $methods->links("pagination::bootstrap-4")
        ]);
    }
    
    public function filterMedicine(Request $request)
    {
        $query = Medicine::with('supplier');

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }

        if ($request->filled('supplier')) {
            $query->where('supplierId', $request->supplier);
        }

        if ($request->filled('category')) {
            $query->where('categoryId', $request->category);
        }

        $medicine = $query->paginate(50);

        return response()->json([
            'data' => $medicine->items(),
            'links' => (string) $medicine->links("pagination::bootstrap-4")
        ]);
        
    }
    public function filterExpireMedicine(Request $request)
    {
        $query = Stock::with(['medicine'=>function($query) use ($request){
            if ($request->filled('name')) {
                $query->where('name', 'like', '%' . $request->name . '%');
            }
            if ($request->filled('supplier')) {
                $query->where('supplierId', $request->supplier);
            }
            if ($request->filled('category')) {
                $query->where('categoryId', $request->category);
            }
        },'medicine.supplier'])
        ->where('expire_date', '<', date('Y-m-d'))
        ->select('medicineId','expire_date', DB::raw('SUM(qty) as total_qty'))
        ->groupBy('expire_date')
        ->groupBy('medicineId');

        if ($request->filled('fromDate') && $request->filled('toDate')) {
            $query->whereBetween(DB::raw('DATE(expire_date)'), [$request->fromDate, $request->toDate]);
        }
        
        $dataList = $query->paginate(50);

        return response()->json([
            'data' => $dataList->items(),
            'links' => (string) $dataList->links("pagination::bootstrap-4")
        ]);
        
    }
}
