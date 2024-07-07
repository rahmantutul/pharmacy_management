<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\LeafController;
use App\Http\Controllers\MedicineController;
use App\Http\Controllers\PaymentMethodController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\TypeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VendorController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('clear-compiled');
    Artisan::call('optimize:clear');
    
    return redirect()->back();
})->name('cache.clear');

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['prefix'=>'user','as'=>'users.'], function(){
    Route::get('/', [UserController::class, 'index'])->name('index');
    Route::get('/create', [UserController::class, 'create'])->name('create');
    Route::post('/', [UserController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
    Route::post('/update', [UserController::class, 'update'])->name('update');
    Route::get('/destory/{id}', [UserController::class, 'destroy'])->name('destroy');
});
//--------------End UserController-------------------------------------

Route::get('/role/index', [RoleController::class, 'index'])->name('role.index');
Route::get('/role/create',[RoleController::class, 'create'])->name('role.create');
Route::post('/role/store',[RoleController::class, 'store'])->name('role.store');
Route::get('/role/edit/{id}',[RoleController::class, 'edit'])->name('role.edit');
Route::put('/role/update',[RoleController::class, 'update'])->name('role.update');
Route::delete('/role/destroy/{id}',[RoleController::class, 'destroy']);
Route::get('/role-access/{id}', [RoleController::class, 'access_index'])->name('role.access');
Route::post('/role-access/store',[RoleController::class, 'access_store'])->name('role.access.store');
//--------------End RoleController-------------------------------------

Route::get('/permission/index', [PermissionController::class, 'index'])->name('permission.index');
Route::get('/permission/create',[PermissionController::class, 'create'])->name('permission.create');
Route::post('/permission/store',[PermissionController::class, 'store'])->name('permission.store');
Route::get('/permission/edit/{id}',[PermissionController::class, 'edit'])->name('permission.edit');
Route::post('/permission/update',[PermissionController::class, 'update'])->name('permission.update');
Route::delete('/permission/destroy/{id}',[PermissionController::class, 'destroy']);
//--------------End PermissionController-------------------------------------

Route::get('/gsetting/index', [SettingsController::class, 'gsettingindex'])->name('gsetting.index');
Route::post('/gsetting/update', [SettingsController::class, 'gsettingupdate'])->name('gsetting.update');

Route::get('/esetting/index', [SettingsController::class, 'emailsettingindex'])->name('esetting.index');
Route::post('/esetting/update', [SettingsController::class, 'emailsettingupdate'])->name('esetting.update');
//--------------End SettingsController-------------------------------------

Route::group(['prefix'=>'customer','as'=>'customer.'], function(){
    Route::get('/', [CustomerController::class, 'index'])->name('index');
    Route::get('/create', [CustomerController::class, 'create'])->name('create');
    Route::post('/', [CustomerController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [CustomerController::class, 'edit'])->name('edit');
    Route::post('/update', [CustomerController::class, 'update'])->name('update');
    Route::get('/destory/{id}', [CustomerController::class, 'destroy'])->name('destroy');
    Route::get('/view/{id}', [CustomerController::class, 'view'])->name('view');
});
//--------------End CustomerController-------------------------------------

Route::group(['prefix'=>'ecategory','as'=>'ecategory.'], function(){
    Route::get('/', [ExpenseCategoryController::class, 'index'])->name('index');
    Route::get('/create', [ExpenseCategoryController::class, 'create'])->name('create');
    Route::post('/', [ExpenseCategoryController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ExpenseCategoryController::class, 'edit'])->name('edit');
    Route::post('/update', [ExpenseCategoryController::class, 'update'])->name('update');
    Route::get('/destory/{id}', [ExpenseCategoryController::class, 'destroy'])->name('destroy');
});
//--------------End ExpenseCategoryController-------------------------------------

Route::group(['prefix'=>'expense','as'=>'expense.'], function(){
    Route::get('/', [ExpenseController::class, 'index'])->name('index');
    Route::get('/create', [ExpenseController::class, 'create'])->name('create');
    Route::post('/', [ExpenseController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [ExpenseController::class, 'edit'])->name('edit');
    Route::post('/update', [ExpenseController::class, 'update'])->name('update');
    Route::get('/destory/{id}', [ExpenseController::class, 'destroy'])->name('destroy');
});
//--------------End ExpenseCategoryController-------------------------------------

Route::group(['prefix'=>'supplier','as'=>'supplier.'], function(){
    Route::get('/', [SupplierController::class, 'index'])->name('index');
    Route::get('/create', [SupplierController::class, 'create'])->name('create');
    Route::post('/', [SupplierController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('edit');
    Route::post('/update', [SupplierController::class, 'update'])->name('update');
    Route::get('/destory/{id}', [SupplierController::class, 'destroy'])->name('destroy');
    Route::get('/view/{id}', [SupplierController::class, 'view'])->name('view');
});
//--------------End CustomerController-------------------------------------

Route::get('/category/index', [CategoryController::class, 'index'])->name('category.index');
Route::get('/category/create',[CategoryController::class, 'create'])->name('category.create');
Route::post('/category/store',[CategoryController::class, 'store'])->name('category.store');
Route::get('/category/edit/{id}',[CategoryController::class, 'edit'])->name('category.edit');
Route::post('/category/update',[CategoryController::class, 'update'])->name('category.update');
Route::delete('/category/destroy/{id}',[CategoryController::class, 'destroy']);
//--------------End CategoryController-------------------------------------

Route::get('/unit/index', [UnitController::class, 'index'])->name('unit.index');
Route::get('/unit/create',[UnitController::class, 'create'])->name('unit.create');
Route::post('/unit/store',[UnitController::class, 'store'])->name('unit.store');
Route::get('/unit/edit/{id}',[UnitController::class, 'edit'])->name('unit.edit');
Route::post('/unit/update',[UnitController::class, 'update'])->name('unit.update');
Route::delete('/unit/destroy/{id}',[UnitController::class, 'destroy']);
//--------------End UnitController-------------------------------------

Route::group(['prefix'=>'leaf','as'=>'leaf.'], function(){
    Route::get('/', [LeafController::class, 'index'])->name('index');
    Route::get('/create', [LeafController::class, 'create'])->name('create');
    Route::post('/', [LeafController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [LeafController::class, 'edit'])->name('edit');
    Route::post('/update', [LeafController::class, 'update'])->name('update');
    Route::get('/destory/{id}', [LeafController::class, 'destroy'])->name('destroy');
    Route::get('/view/{id}', [LeafController::class, 'view'])->name('view');
});
//--------------End LeafController-------------------------------------

Route::group(['prefix'=>'type','as'=>'type.'], function(){
    Route::get('/', [TypeController::class, 'index'])->name('index');
    Route::get('/create', [TypeController::class, 'create'])->name('create');
    Route::post('/', [TypeController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [TypeController::class, 'edit'])->name('edit');
    Route::post('/update', [TypeController::class, 'update'])->name('update');
    Route::delete('/destory/{id}', [TypeController::class, 'destroy'])->name('destroy');
});
//--------------End TypeController-------------------------------------

Route::group(['prefix'=>'vendor','as'=>'vendor.'], function(){
    Route::get('/', [VendorController::class, 'index'])->name('index');
    Route::get('/create', [VendorController::class, 'create'])->name('create');
    Route::post('/', [VendorController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [VendorController::class, 'edit'])->name('edit');
    Route::post('/update', [VendorController::class, 'update'])->name('update');
    Route::get('/destory/{id}', [VendorController::class, 'destroy'])->name('destroy');
    Route::get('/view/{id}', [VendorController::class, 'view'])->name('view');
});
//--------------End CustomerController-------------------------------------

Route::group(['prefix'=>'medicine','as'=>'medicine.'], function(){
    Route::get('/', [MedicineController::class, 'index'])->name('index');
    Route::get('/create', [MedicineController::class, 'create'])->name('create');
    Route::post('/', [MedicineController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [MedicineController::class, 'edit'])->name('edit');
    Route::post('/update', [MedicineController::class, 'update'])->name('update');
    Route::get('/destory/{id}', [MedicineController::class, 'destroy'])->name('destroy');
    Route::get('/view/{id}', [MedicineController::class, 'view'])->name('view');
});
//--------------End MedicienController-------------------------------------

Route::group(['prefix'=>'payment','as'=>'payment.'], function(){
    Route::get('/', [PaymentMethodController::class, 'index'])->name('index');
    Route::get('/create', [PaymentMethodController::class, 'create'])->name('create');
    Route::post('/', [PaymentMethodController::class, 'store'])->name('store');
    Route::get('/edit/{id}', [PaymentMethodController::class, 'edit'])->name('edit');
    Route::post('/update', [PaymentMethodController::class, 'update'])->name('update');
    Route::delete('/destory/{id}', [PaymentMethodController::class, 'destroy'])->name('destroy');
});
//--------------End MedicienController-------------------------------------

Route::group(['prefix'=>'purchase','as'=>'purchase.'], function(){
    Route::get('/create', [PurchaseController::class, 'create'])->name('create');
    Route::post('/', [PurchaseController::class, 'store'])->name('store');
    Route::get('/seaarch-medicine', [PurchaseController::class, 'search_medicine'])->name('search');
    Route::get('/cart/add', [PurchaseController::class, 'addToCart'])->name('cart.add');
    Route::get('/cart/remove', [PurchaseController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/index', [PurchaseController::class, 'index'])->name('index');
    Route::get('/details/{id}', [PurchaseController::class, 'details'])->name('details');
    Route::get('/return/{id}', [PurchaseController::class, 'returnItem'])->name('return');
    Route::post('/return/store', [PurchaseController::class, 'storeReturnItem'])->name('return.store');
    Route::get('/delete/{id}', [PurchaseController::class, 'delete'])->name('delete');
});

Route::group(['prefix'=>'sales','as'=>'sales.'], function(){
    Route::get('/create', [SalesController::class, 'create'])->name('create');
    Route::get('/', [SalesController::class, 'filter'])->name('medicines.filter');
    Route::get('/cart/add', [SalesController::class, 'addToCart'])->name('cart.add');
});

//--------------End PurchaseController-------------------------------------