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
Route::get('/conversations/syn', [App\Http\Controllers\ConversationController::class, 'syn_data'])->name('conversations.syn');
Route::post('/conversations/send_message', [App\Http\Controllers\ConversationController::class, 'send_message'])->name('conversations.send_message');
// Admin Panel Start
Route::group(['middleware'=>['adminpanel'],'prefix'=>'admin','as' => 'admin.'],function(){
    // General Data
    Route::group(['prefix'=>'general','as' => 'general.'],function () {
        Route::group(['prefix'=>'select','as' => 'select.'],function () {
            Route::get('vendors', [App\Http\Controllers\GeneralController::class, 'select2_vendor'])->name('vendors');
            Route::get('products', [App\Http\Controllers\GeneralController::class, 'select2_products'])->name('products');
        });
        Route::group(['prefix'=>'searching','as' => 'searching.'],function () {
            Route::get('products', [App\Http\Controllers\GeneralController::class, 'searching_products'])->name('products');
            Route::get('materials', [App\Http\Controllers\GeneralController::class, 'searching_materials'])->name('materials');
            Route::get('finish_goods', [App\Http\Controllers\GeneralController::class, 'searching_finish_goods'])->name('finish_goods');
        });
        Route::group(['prefix'=>'searching','as' => 'list.'],function () {
            Route::get('product_vendors', [App\Http\Controllers\GeneralController::class, 'product_vendors'])->name('product_vendors');
        });
    });



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

        Route::get('products/{id}', [App\Http\Controllers\VendorsController::class, 'products'])->name('products');
        Route::post('products/add', [App\Http\Controllers\VendorsController::class, 'product_add'])->name('products.add');
        Route::get('products/destroy/{id}', [App\Http\Controllers\VendorsController::class, 'product_destroy'])->name('products.destroy');

        Route::get('documents/{id}', [App\Http\Controllers\DocumentsController::class, 'index'])->name('documents');
        Route::post('documents/store', [App\Http\Controllers\DocumentsController::class, 'store'])->name('documents.store');
        Route::put('documents/uploading', [App\Http\Controllers\DocumentsController::class, 'uploading'])->name('documents.uploading');
        Route::get('documents/destroy/{id}', [App\Http\Controllers\DocumentsController::class, 'destroy'])->name('documents.destory');


    });
    // Manufacturers
    Route::group(['prefix'=>'manufacturers','as' => 'manufacturers.'],function () {
    
        Route::get('/', [App\Http\Controllers\ManufacturersController::class, 'index'])->name('list');
        Route::get('/view/{id}', [App\Http\Controllers\ManufacturersController::class, 'view'])->name('view');
        Route::post('/data', [App\Http\Controllers\ManufacturersController::class, 'data'])->name('data');
    
        Route::get('/add', [App\Http\Controllers\ManufacturersController::class, 'add'])->name('add');
        Route::post('/store', [App\Http\Controllers\ManufacturersController::class, 'store'])->name('store');
    
        Route::get('/edit/{id}', [App\Http\Controllers\ManufacturersController::class, 'edit'])->name('edit');
        Route::post('/update', [App\Http\Controllers\ManufacturersController::class, 'update'])->name('update');
    
        Route::get('/destroy/{id}', [App\Http\Controllers\ManufacturersController::class, 'destroy'])->name('destroy');

        
        Route::get('/poc/{id}', [App\Http\Controllers\ManufacturersController::class, 'poc'])->name('poc');
        Route::post('/poc_data', [App\Http\Controllers\ManufacturersController::class, 'poc_data'])->name('poc.data');
        
        Route::get('poc/add/{id}', [App\Http\Controllers\ManufacturersController::class, 'poc_add'])->name('poc.add');
        Route::post('poc/store', [App\Http\Controllers\ManufacturersController::class, 'poc_store'])->name('poc.store');
        
        Route::get('poc/edit/{id}', [App\Http\Controllers\ManufacturersController::class, 'poc_edit'])->name('poc.edit');
        Route::post('poc/update', [App\Http\Controllers\ManufacturersController::class, 'poc_update'])->name('poc.update');

        Route::get('poc/destroy/{id}', [App\Http\Controllers\ManufacturersController::class, 'poc_destroy'])->name('poc.destroy');

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
    // Taxes
    Route::group(['prefix'=>'taxes','as' => 'taxes.'],function () {
        Route::get('/', [App\Http\Controllers\TaxesController::class, 'index'])->name('list');
        Route::post('/data', [App\Http\Controllers\TaxesController::class, 'data'])->name('data');
    
        Route::get('/add', [App\Http\Controllers\TaxesController::class, 'add'])->name('add');
        Route::post('/store', [App\Http\Controllers\TaxesController::class, 'store'])->name('store');
    
        Route::get('/edit/{id}', [App\Http\Controllers\TaxesController::class, 'edit'])->name('edit');
        Route::post('/update', [App\Http\Controllers\TaxesController::class, 'update'])->name('update');
    
        Route::get('/destroy/{id}', [App\Http\Controllers\TaxesController::class, 'destroy'])->name('destroy');
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
    // Brands
    Route::group(['prefix'=>'brands','as' => 'brands.'],function () {
        Route::get('/', [App\Http\Controllers\BrandsController::class, 'index'])->name('list');
        Route::post('/data', [App\Http\Controllers\BrandsController::class, 'data'])->name('data');
    
        Route::get('/add', [App\Http\Controllers\BrandsController::class, 'add'])->name('add');
        Route::post('/store', [App\Http\Controllers\BrandsController::class, 'store'])->name('store');
    
        Route::get('/edit/{id}', [App\Http\Controllers\BrandsController::class, 'edit'])->name('edit');
        Route::post('/update', [App\Http\Controllers\BrandsController::class, 'update'])->name('update');
    
        Route::get('/destroy/{id}', [App\Http\Controllers\BrandsController::class, 'destroy'])->name('destroy');
    });
    // Products
    Route::group(['prefix'=>'products','as' => 'products.'],function () {
        Route::get('/', [App\Http\Controllers\ProductsController::class, 'index'])->name('list');
        Route::post('/data', [App\Http\Controllers\ProductsController::class, 'data'])->name('data');
    
        Route::get('/add', [App\Http\Controllers\ProductsController::class, 'add'])->name('add');
        Route::post('/store', [App\Http\Controllers\ProductsController::class, 'store'])->name('store');
    
        Route::get('/edit/{id}', [App\Http\Controllers\ProductsController::class, 'edit'])->name('edit');
        Route::post('/update', [App\Http\Controllers\ProductsController::class, 'update'])->name('update');
    
        Route::get('/destroy/{id}', [App\Http\Controllers\ProductsController::class, 'destroy'])->name('destroy');

        Route::get('vendors/{id}', [App\Http\Controllers\ProductsController::class, 'vendors'])->name('vendors');
        Route::post('vendors/add', [App\Http\Controllers\ProductsController::class, 'vendor_add'])->name('vendors.add');
        Route::get('vendors/destroy/{id}', [App\Http\Controllers\ProductsController::class, 'vendor_destroy'])->name('vendors.destroy');

    });
    // Finished Goods
    Route::group(['prefix'=>'finsihs','as' => 'finishedgoods.'],function () {
        Route::get('/', [App\Http\Controllers\FinishedgoodsController::class, 'index'])->name('list');
        Route::post('/data', [App\Http\Controllers\FinishedgoodsController::class, 'data'])->name('data');
    
        Route::get('/add', [App\Http\Controllers\FinishedgoodsController::class, 'add'])->name('add');
        Route::post('/store', [App\Http\Controllers\FinishedgoodsController::class, 'store'])->name('store');
    
        Route::get('/edit/{id}', [App\Http\Controllers\FinishedgoodsController::class, 'edit'])->name('edit');
        Route::post('/update', [App\Http\Controllers\FinishedgoodsController::class, 'update'])->name('update');
    
        Route::get('/destroy/{id}', [App\Http\Controllers\FinishedgoodsController::class, 'destroy'])->name('destroy');
    });
    // Quotations
    Route::group(['prefix'=>'quotations','as' => 'quotations.'],function () {
        Route::get('/', [App\Http\Controllers\QuotationsController::class, 'index'])->name('list');
        Route::get('/create', [App\Http\Controllers\QuotationsController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\QuotationsController::class, 'store'])->name('store');
        
        Route::get('/detail/{id}', [App\Http\Controllers\QuotationsController::class, 'detail'])->name('detail');
        Route::get('/destroy/{id}', [App\Http\Controllers\QuotationsController::class, 'destroy'])->name('destroy');
        Route::post('/submit_price', [App\Http\Controllers\QuotationsController::class, 'submit_price'])->name('submit_price');
        
        Route::post('/add_materail', [App\Http\Controllers\QuotationsController::class, 'add_materail'])->name('add_materail');
        Route::post('/udpate_materail', [App\Http\Controllers\QuotationsController::class, 'udpate_materail'])->name('udpate_materail');
        Route::get('/delete_materail/{id}', [App\Http\Controllers\QuotationsController::class, 'delete_materail'])->name('delete_materail');
        
        Route::post('/add_addonmaterail', [App\Http\Controllers\QuotationsController::class, 'add_addonmaterail'])->name('add_addonmaterail');
        Route::post('/udpate_addonmaterail', [App\Http\Controllers\QuotationsController::class, 'udpate_addonmaterail'])->name('udpate_addonmaterail');
        Route::get('/delete_addonmaterail/{id}', [App\Http\Controllers\QuotationsController::class, 'delete_addonmaterail'])->name('delete_addonmaterail');

        Route::post('/project_detail_submit', [App\Http\Controllers\QuotationsController::class, 'project_detail_submit'])->name('project_detail_submit');
        Route::post('/order_create', [App\Http\Controllers\QuotationsController::class, 'order_create'])->name('order_create');
        Route::post('/submit_ponumber', [App\Http\Controllers\QuotationsController::class, 'submit_ponumber'])->name('submit_ponumber');
        Route::post('/attachmentupload', [App\Http\Controllers\QuotationsController::class, 'attachmentupload'])->name('attachmentupload');
        Route::get('/delete_file/{id}', [App\Http\Controllers\QuotationsController::class, 'delete_file'])->name('delete_file');


    });
    // Orders
    Route::group(['prefix'=>'orders','as' => 'orders.'],function () {
        Route::get('/', [App\Http\Controllers\OrdersController::class, 'index'])->name('list');
        Route::get('/detail/{id}', [App\Http\Controllers\OrdersController::class, 'detail'])->name('detail');
        Route::post('/submit_estimated_date', [App\Http\Controllers\OrdersController::class, 'submit_estimated_date'])->name('submit_estimated_date');
        Route::post('/submit_deliverydate_date', [App\Http\Controllers\OrdersController::class, 'submit_deliverydate_date'])->name('submit_deliverydate_date');
    });


});
// Admin Panel End
// Customers Panel Start
Route::group(['middleware'=>['customerpanel'],'prefix'=>'customer','as' => 'customer.'],function(){
    // General Data
    Route::group(['prefix'=>'general','as' => 'general.'],function () {
        Route::group(['prefix'=>'select','as' => 'select.'],function () {
            Route::get('vendors', [App\Http\Controllers\GeneralController::class, 'select2_vendor'])->name('vendors');
            Route::get('products', [App\Http\Controllers\GeneralController::class, 'select2_products'])->name('products');
        });
        Route::group(['prefix'=>'searching','as' => 'searching.'],function () {
            Route::get('products', [App\Http\Controllers\GeneralController::class, 'searching_products'])->name('products');
            Route::get('materials', [App\Http\Controllers\GeneralController::class, 'searching_materials'])->name('materials');
            Route::get('finish_goods', [App\Http\Controllers\GeneralController::class, 'searching_finish_goods'])->name('finish_goods');
        });
        Route::group(['prefix'=>'searching','as' => 'list.'],function () {
            Route::get('product_vendors', [App\Http\Controllers\GeneralController::class, 'product_vendors'])->name('product_vendors');
        });
    });
    // Dashbaord
    Route::get('dashboard', [App\Http\Controllers\Customer\DashboardController::class, 'index'])->name('dashboard');
    // Employees
    Route::group(['prefix'=>'employees','as' => 'employees.'],function () {
        Route::get('/', [App\Http\Controllers\Customer\EmployeesController::class, 'index'])->name('list');
        Route::get('/view/{id}', [App\Http\Controllers\Customer\EmployeesController::class, 'view'])->name('view');
        Route::post('/data', [App\Http\Controllers\Customer\EmployeesController::class, 'data'])->name('data');
    
        Route::get('/add', [App\Http\Controllers\Customer\EmployeesController::class, 'add'])->name('add');
        Route::post('/store', [App\Http\Controllers\Customer\EmployeesController::class, 'store'])->name('store');
    
        Route::get('/edit/{id}', [App\Http\Controllers\Customer\EmployeesController::class, 'edit'])->name('edit');
        Route::post('/update', [App\Http\Controllers\Customer\EmployeesController::class, 'update'])->name('update');
    
        Route::get('/destroy/{id}', [App\Http\Controllers\Customer\EmployeesController::class, 'destroy'])->name('destroy');
    });
    // Categories
    Route::group(['prefix'=>'categories','as' => 'categories.'],function () {
        Route::get('/', [App\Http\Controllers\Customer\CategoriesController::class, 'index'])->name('list');
        Route::post('/data', [App\Http\Controllers\Customer\CategoriesController::class, 'data'])->name('data');
    });
    // Brands
    Route::group(['prefix'=>'brands','as' => 'brands.'],function () {
        Route::get('/', [App\Http\Controllers\Customer\BrandsController::class, 'index'])->name('list');
        Route::post('/data', [App\Http\Controllers\Customer\BrandsController::class, 'data'])->name('data');
    });
    // Products
    Route::group(['prefix'=>'products','as' => 'products.'],function () {
        Route::get('/', [App\Http\Controllers\Customer\ProductsController::class, 'index'])->name('list');
        Route::post('/data', [App\Http\Controllers\Customer\ProductsController::class, 'data'])->name('data');
    });
    // Quotations
    Route::group(['prefix'=>'quotations','as' => 'quotations.'],function () {
        Route::get('/', [App\Http\Controllers\Customer\QuotationsController::class, 'index'])->name('list');
        Route::get('/create', [App\Http\Controllers\Customer\QuotationsController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Customer\QuotationsController::class, 'store'])->name('store');

        Route::get('/detail/{id}', [App\Http\Controllers\Customer\QuotationsController::class, 'detail'])->name('detail');
        Route::get('/destroy/{id}', [App\Http\Controllers\Customer\QuotationsController::class, 'destroy'])->name('destroy');
        Route::post('/submit_price', [App\Http\Controllers\Customer\QuotationsController::class, 'submit_price'])->name('submit_price');
        
        Route::post('/add_materail', [App\Http\Controllers\Customer\QuotationsController::class, 'add_materail'])->name('add_materail');
        Route::post('/udpate_materail', [App\Http\Controllers\Customer\QuotationsController::class, 'udpate_materail'])->name('udpate_materail');
        Route::get('/delete_materail/{id}', [App\Http\Controllers\Customer\QuotationsController::class, 'delete_materail'])->name('delete_materail');
        
        Route::post('/add_addonmaterail', [App\Http\Controllers\Customer\QuotationsController::class, 'add_addonmaterail'])->name('add_addonmaterail');
        Route::post('/udpate_addonmaterail', [App\Http\Controllers\Customer\QuotationsController::class, 'udpate_addonmaterail'])->name('udpate_addonmaterail');
        Route::get('/delete_addonmaterail/{id}', [App\Http\Controllers\Customer\QuotationsController::class, 'delete_addonmaterail'])->name('delete_addonmaterail');

        Route::post('/project_detail_submit', [App\Http\Controllers\Customer\QuotationsController::class, 'project_detail_submit'])->name('project_detail_submit');
        Route::post('/order_create', [App\Http\Controllers\Customer\QuotationsController::class, 'order_create'])->name('order_create');



    
    });
});
// Customers Panel End
// Vendor Panel Start
Route::group(['middleware'=>['vendorpanel'],'prefix'=>'vendor','as' => 'vendor.'],function(){
    // General Data
    Route::group(['prefix'=>'general','as' => 'general.'],function () {
        Route::group(['prefix'=>'select','as' => 'select.'],function () {
            Route::get('vendors', [App\Http\Controllers\GeneralController::class, 'select2_vendor'])->name('vendors');
            Route::get('products', [App\Http\Controllers\GeneralController::class, 'select2_products'])->name('products');
        });
        Route::group(['prefix'=>'searching','as' => 'searching.'],function () {
            Route::get('products', [App\Http\Controllers\GeneralController::class, 'searching_products'])->name('products');
        });
    });
    // Dashbaord
    Route::get('dashboard', [App\Http\Controllers\Vendor\DashboardController::class, 'index'])->name('dashboard');
    // Employees
    Route::group(['prefix'=>'employees','as' => 'employees.'],function () {
        Route::get('/', [App\Http\Controllers\Vendor\EmployeesController::class, 'index'])->name('list');
        Route::get('/view/{id}', [App\Http\Controllers\Vendor\EmployeesController::class, 'view'])->name('view');
        Route::post('/data', [App\Http\Controllers\Vendor\EmployeesController::class, 'data'])->name('data');
    
        Route::get('/add', [App\Http\Controllers\Vendor\EmployeesController::class, 'add'])->name('add');
        Route::post('/store', [App\Http\Controllers\Vendor\EmployeesController::class, 'store'])->name('store');
    
        Route::get('/edit/{id}', [App\Http\Controllers\Vendor\EmployeesController::class, 'edit'])->name('edit');
        Route::post('/update', [App\Http\Controllers\Vendor\EmployeesController::class, 'update'])->name('update');
    
        Route::get('/destroy/{id}', [App\Http\Controllers\Vendor\EmployeesController::class, 'destroy'])->name('destroy');
    });
    // Categories
    Route::group(['prefix'=>'categories','as' => 'categories.'],function () {
        Route::get('/', [App\Http\Controllers\Vendor\CategoriesController::class, 'index'])->name('list');
        Route::post('/data', [App\Http\Controllers\Vendor\CategoriesController::class, 'data'])->name('data');
    });
    // Brands
    Route::group(['prefix'=>'brands','as' => 'brands.'],function () {
        Route::get('/', [App\Http\Controllers\Vendor\BrandsController::class, 'index'])->name('list');
        Route::post('/data', [App\Http\Controllers\Vendor\BrandsController::class, 'data'])->name('data');
    });
    // Products
    Route::group(['prefix'=>'products','as' => 'products.'],function () {
        Route::get('/', [App\Http\Controllers\Vendor\ProductsController::class, 'index'])->name('list');
        Route::post('/data', [App\Http\Controllers\Vendor\ProductsController::class, 'data'])->name('data');
    });
    // Quotations
    Route::group(['prefix'=>'quotations','as' => 'quotations.'],function () {
        Route::get('/', [App\Http\Controllers\Vendor\QuotationsController::class, 'index'])->name('list');
        Route::get('/create', [App\Http\Controllers\Vendor\QuotationsController::class, 'create'])->name('create');
        Route::post('/store', [App\Http\Controllers\Vendor\QuotationsController::class, 'store'])->name('store');
        Route::get('/detail/{id}', [App\Http\Controllers\Vendor\QuotationsController::class, 'detail'])->name('detail');
        Route::post('/submit_price', [App\Http\Controllers\Vendor\QuotationsController::class, 'submit_price'])->name('submit_price');
        Route::get('/destroy/{id}', [App\Http\Controllers\Vendor\QuotationsController::class, 'destroy'])->name('destroy');
    
    });
});
// Vendors Panel End

