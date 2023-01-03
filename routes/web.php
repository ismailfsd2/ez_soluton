<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Login

Route::get('/', [App\Http\Controllers\LoginController::class, 'index'])->name('login');
Route::post('/login/submit', [App\Http\Controllers\LoginController::class, 'submit'])->name('login.submit');
Route::get('/logout', [App\Http\Controllers\LoginController::class, 'logout'])->name('logout');
Route::get('/forget_password', [App\Http\Controllers\LoginController::class, 'forget_password'])->name('forget_password');
Route::post('/forget_password/submit', [App\Http\Controllers\LoginController::class, 'forget_password_submit'])->name('forget_password.submit');
// Admin Panel Start
Route::group(['middleware'=>['adminpanel'],'prefix'=>'admin','as' => 'admin.'],function(){
    // Dashbaord
    Route::get('dashboard', [App\Http\Controllers\DashboardController::class, 'index'])->name('dashboard');
    // Employees
    Route::group(['prefix'=>'employees','as' => 'employees.'],function () {
        Route::get('/', [App\Http\Controllers\EmployeesController::class, 'index'])->name('list');
        Route::get('/view/{id}', [App\Http\Controllers\EmployeesController::class, 'view'])->name('view');
        Route::post('/data', [App\Http\Controllers\EmployeesController::class, 'data'])->name('data');
    
        Route::get('/add', [App\Http\Controllers\EmployeesController::class, 'add'])->name('add');
        Route::post('/store', [App\Http\Controllers\EmployeesController::class, 'store'])->name('store');
    
        Route::get('/edit/{id}', [App\Http\Controllers\EmployeesController::class, 'edit'])->name('edit');
        Route::post('/update', [App\Http\Controllers\EmployeesController::class, 'update'])->name('update');
    
        Route::get('/destroy/{id}', [App\Http\Controllers\EmployeesController::class, 'destroy'])->name('destroy');
    });
    // Vendors
    Route::group(['prefix'=>'vendors','as' => 'vendors.'],function () {
    
        Route::get('/', [App\Http\Controllers\VendorsController::class, 'index'])->name('list');
        Route::get('/view/{id}', [App\Http\Controllers\VendorsController::class, 'view'])->name('view');
        Route::post('/data', [App\Http\Controllers\VendorsController::class, 'data'])->name('data');
    
        Route::get('/add', [App\Http\Controllers\VendorsController::class, 'add'])->name('add');
        Route::post('/store', [App\Http\Controllers\VendorsController::class, 'store'])->name('store');
    
        Route::get('/edit/{id}', [App\Http\Controllers\VendorsController::class, 'edit'])->name('edit');
        Route::post('/update', [App\Http\Controllers\VendorsController::class, 'update'])->name('update');
    
        Route::get('/destroy/{id}', [App\Http\Controllers\VendorsController::class, 'destroy'])->name('destroy');

        
        Route::get('/poc/{id}', [App\Http\Controllers\VendorsController::class, 'poc'])->name('poc');
        Route::post('/poc_data', [App\Http\Controllers\VendorsController::class, 'poc_data'])->name('poc.data');
        
        Route::get('poc/add/{id}', [App\Http\Controllers\VendorsController::class, 'poc_add'])->name('poc.add');
        Route::post('poc/store', [App\Http\Controllers\VendorsController::class, 'poc_store'])->name('poc.store');
        
        Route::get('poc/edit/{id}', [App\Http\Controllers\VendorsController::class, 'poc_edit'])->name('poc.edit');
        Route::post('poc/update', [App\Http\Controllers\VendorsController::class, 'poc_update'])->name('poc.update');

        Route::get('poc/destroy/{id}', [App\Http\Controllers\VendorsController::class, 'poc_destroy'])->name('poc.destroy');



    });
    // Customers
    Route::group(['prefix'=>'customers','as' => 'customers.'],function () {
    
        Route::get('/', [App\Http\Controllers\CustomersController::class, 'index'])->name('list');
        Route::get('/view/{id}', [App\Http\Controllers\CustomersController::class, 'view'])->name('view');
        Route::post('/data', [App\Http\Controllers\CustomersController::class, 'data'])->name('data');
    
        Route::get('/add', [App\Http\Controllers\CustomersController::class, 'add'])->name('add');
        Route::post('/store', [App\Http\Controllers\CustomersController::class, 'store'])->name('store');
    
        Route::get('/edit/{id}', [App\Http\Controllers\CustomersController::class, 'edit'])->name('edit');
        Route::post('/update', [App\Http\Controllers\CustomersController::class, 'update'])->name('update');
    
        Route::get('/destroy/{id}', [App\Http\Controllers\CustomersController::class, 'destroy'])->name('destroy');
        
        Route::get('/poc/{id}', [App\Http\Controllers\CustomersController::class, 'poc'])->name('poc');
        Route::post('/poc_data', [App\Http\Controllers\CustomersController::class, 'poc_data'])->name('poc.data');
        
        Route::get('poc/add/{id}', [App\Http\Controllers\CustomersController::class, 'poc_add'])->name('poc.add');
        Route::post('poc/store', [App\Http\Controllers\CustomersController::class, 'poc_store'])->name('poc.store');
        
        Route::get('poc/edit/{id}', [App\Http\Controllers\CustomersController::class, 'poc_edit'])->name('poc.edit');
        Route::post('poc/update', [App\Http\Controllers\CustomersController::class, 'poc_update'])->name('poc.update');

        Route::get('poc/destroy/{id}', [App\Http\Controllers\CustomersController::class, 'poc_destroy'])->name('poc.destroy');

    });
    // Warehouses
    Route::group(['prefix'=>'warehouses','as' => 'warehouses.'],function () {
        Route::get('/', [App\Http\Controllers\WarehousesController::class, 'index'])->name('list');
        Route::post('/data', [App\Http\Controllers\WarehousesController::class, 'data'])->name('data');
    
        Route::get('/add', [App\Http\Controllers\WarehousesController::class, 'add'])->name('add');
        Route::post('/store', [App\Http\Controllers\WarehousesController::class, 'store'])->name('store');
    
        Route::get('/edit/{id}', [App\Http\Controllers\WarehousesController::class, 'edit'])->name('edit');
        Route::post('/update', [App\Http\Controllers\WarehousesController::class, 'update'])->name('update');
    
        Route::get('/destroy/{id}', [App\Http\Controllers\WarehousesController::class, 'destroy'])->name('destroy');
    });
    // Units
    Route::group(['prefix'=>'units','as' => 'units.'],function () {
        Route::get('/', [App\Http\Controllers\UnitsController::class, 'index'])->name('list');
        Route::post('/data', [App\Http\Controllers\UnitsController::class, 'data'])->name('data');
    
        Route::get('/add', [App\Http\Controllers\UnitsController::class, 'add'])->name('add');
        Route::post('/store', [App\Http\Controllers\UnitsController::class, 'store'])->name('store');
    
        Route::get('/edit/{id}', [App\Http\Controllers\UnitsController::class, 'edit'])->name('edit');
        Route::post('/update', [App\Http\Controllers\UnitsController::class, 'update'])->name('update');
    
        Route::get('/destroy/{id}', [App\Http\Controllers\UnitsController::class, 'destroy'])->name('destroy');
    });
    // Categories
    Route::group(['prefix'=>'categories','as' => 'categories.'],function () {
        Route::get('/', [App\Http\Controllers\CategoriesController::class, 'index'])->name('list');
        Route::post('/data', [App\Http\Controllers\CategoriesController::class, 'data'])->name('data');
    
        Route::get('/add', [App\Http\Controllers\CategoriesController::class, 'add'])->name('add');
        Route::post('/store', [App\Http\Controllers\CategoriesController::class, 'store'])->name('store');
    
        Route::get('/edit/{id}', [App\Http\Controllers\CategoriesController::class, 'edit'])->name('edit');
        Route::post('/update', [App\Http\Controllers\CategoriesController::class, 'update'])->name('update');
    
        Route::get('/destroy/{id}', [App\Http\Controllers\CategoriesController::class, 'destroy'])->name('destroy');
    });
});
// Admin Panel End
