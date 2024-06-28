<?php

use App\Http\Controllers\PermissionController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Auth::routes();

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