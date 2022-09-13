<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\{UserManagementController,SupplierController,
    ExpenseInvoiceController,StockProductListController,ProductExpenseController,
    ProductLimitController,MenuItemController,OrderController,OrderDetailsController};



    Route::get('/', function () {return redirect()->route('login');});

    Auth::routes();

    /************************************************************
     ***          Home Route Are Here                    ***
     ************************************************************/
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



    /************************************************************
     ***          User Manegement Route Are Here              ***
     ************************************************************/
    Route::prefix('user')->middleware('auth')->group(function () {
    Route::get('/view', [UserManagementController::class, 'view'])->name('user_management.view');
    Route::post('/store', [UserManagementController::class, 'store'])->name('user_management.store');
    Route::get('/edit/{id}', [UserManagementController::class, 'edit'])->name('user_management.edit');
    Route::post('/update/{id}', [UserManagementController::class, 'update'])->name('user_management.update');
    Route::get('/delete/{id}', [UserManagementController::class, 'delete'])->name('user_management.delete');
    Route::get('/profile/{id}', [UserManagementController::class, 'AdminProfile'])->name('admin.profile');
    });

    /************************************************************
     ***          Product Limit Route Are Here               ***
     ************************************************************/
    Route::prefix('product-limit')->middleware('auth')->group(function () {
    Route::get('/view', [ProductLimitController::class, 'view'])->name('product_limit.view');
    Route::post('/store', [ProductLimitController::class, 'store'])->name('product_limit.store');
    Route::get('/edit/{id}', [ProductLimitController::class, 'edit'])->name('product_limit.edit');
    Route::post('/update/{id}', [ProductLimitController::class, 'update'])->name('product_limit.update');
    Route::get('/delete/{id}', [ProductLimitController::class, 'delete'])->name('product_limit.delete');
    });


    /************************************************************
     ***          Suppliers Route Are Here                    ***
     ************************************************************/
    Route::prefix('supplier')->middleware('auth')->group(function () {
    Route::get('/view', [SupplierController::class, 'view'])->name('supplier.view');
    Route::post('/store', [SupplierController::class, 'store'])->name('supplier.store');
    Route::get('/edit/{id}', [SupplierController::class, 'edit'])->name('supplier.edit');
    Route::post('/update/{id}', [SupplierController::class, 'update'])->name('supplier.update');
    Route::get('/delete/{id}', [SupplierController::class, 'delete'])->name('supplier.delete');
    });

    /************************************************************
     ***          Expense Invoice Route Are Here              ***
     ************************************************************/
    Route::prefix('expense-invoice')->middleware('auth')->group(function () {
    Route::get('/view', [ExpenseInvoiceController::class, 'view'])->name('expense_invoice.view');
    Route::get('/add_form', [ExpenseInvoiceController::class, 'addForm'])->name('expense_invoice.add_form');
    Route::post('/store', [ExpenseInvoiceController::class, 'store'])->name('expense_invoice.store');
    Route::get('/show/{id}', [ExpenseInvoiceController::class, 'show'])->name('expense_invoice.show');
    Route::get('/edit/{id}', [ExpenseInvoiceController::class, 'edit'])->name('expense_invoice.edit');
    Route::post('/update/{id}', [ExpenseInvoiceController::class, 'update'])->name('expense_invoice.update');
    Route::get('/delete/{id}', [ExpenseInvoiceController::class, 'delete'])->name('expense_invoice.delete');

    // product name search
    // Route::get('/search-product', [ExpenseInvoiceController::class, 'productNameSearch'])->name('search.product_name');
    // Route::get('/search-product', [ExpenseInvoiceController::class, 'autocomplete'])->name('search.product_name');
    });

    /************************************************************
     ***          Expense Invoice Route Are Here              ***
     ************************************************************/
    Route::prefix('stock-product-list')->middleware('auth')->group(function () {
    Route::get('/view', [StockProductListController::class, 'view'])->name('stock_product_list.view');
    Route::post('/store', [StockProductListController::class, 'store'])->name('stock_product_list.store');
    Route::post('/store', [StockProductListController::class, 'store'])->name('stock_product_list.store');
    Route::get('/edit/{id}', [StockProductListController::class, 'edit'])->name('stock_product_list.edit');
    Route::post('/update/{id}', [StockProductListController::class, 'update'])->name('stock_product_list.update');
    Route::get('/delete/{id}', [StockProductListController::class, 'delete'])->name('stock_product_list.delete');
    });

    /************************************************************
     ***          Kitchen Provide Route Are Here              ***
     ************************************************************/
    Route::prefix('kitchen-product-provide')->middleware('auth')->group(function () {
    Route::get('/view', [ProductExpenseController::class, 'view'])->name('kitchen_product_provide.view');
    Route::get('/add-form', [ProductExpenseController::class, 'addForm'])->name('kitchen_product_provide.add_form');
    Route::post('/store', [ProductExpenseController::class, 'store'])->name('kitchen_product_provide.store');
    Route::get('/edit/{id}', [ProductExpenseController::class, 'edit'])->name('kitchen_product_provide.edit');
    Route::post('/update/{id}', [ProductExpenseController::class, 'update'])->name('kitchen_product_provide.update');
    Route::get('/delete/{id}', [ProductExpenseController::class, 'delete'])->name('kitchen_product_provide.delete');
    });



    /************************************************************
     ***          Menu Item Name Route Are Here               ***
     ************************************************************/
    Route::prefix('menu-items')->middleware('auth')->group(function () {
    Route::get('/view', [MenuItemController::class, 'view'])->name('menu_item.view');
    Route::post('/store', [MenuItemController::class, 'store'])->name('menu_item.store');
    Route::get('/edit/{id}', [MenuItemController::class, 'edit'])->name('menu_item.edit');
    Route::post('/update/{id}', [MenuItemController::class, 'update'])->name('menu_item.update');
    Route::get('/delete/{id}', [MenuItemController::class, 'delete'])->name('menu_item.delete');
    });


    /************************************************************
     ***          Order List Route Are Here                   ***
     ************************************************************/
    Route::prefix('order-items')->middleware('auth')->group(function () {
    Route::get('/view', [OrderController::class, 'view'])->name('order_item.view');
    Route::get('/add', [OrderController::class, 'addForm'])->name('order_item.add_form');
    Route::post('/store', [OrderController::class, 'store'])->name('order_item.store');
    Route::get('/edit/{id}', [OrderController::class, 'edit'])->name('order_item.edit');
    Route::post('/update/{id}', [OrderController::class, 'update'])->name('order_item.update');
    Route::get('/delete/{id}', [OrderController::class, 'delete'])->name('order_item.delete');

    Route::get('/search-item', [OrderController::class, 'autocomplete'])->name('autocomplete.item');
    });
    /************************************************************
     ***          Order Details List Route Are Here           ***
     ************************************************************/
    Route::prefix('order-details')->middleware('auth')->group(function () {
    Route::get('/view', [OrderDetailsController::class, 'view'])->name('order_details.view');
    Route::post('/store', [OrderDetailsController::class, 'store'])->name('order_details.store');
    Route::get('/edit/{id}', [OrderDetailsController::class, 'edit'])->name('order_details.edit');
    Route::post('/update/{id}', [OrderDetailsController::class, 'update'])->name('order_details.update');
    Route::get('/delete/{id}', [OrderDetailsController::class, 'delete'])->name('order_details.delete');
    });


    Route::get('/search-product', [ExpenseInvoiceController::class, 'autocomplete'])->name('autocomplete');


    

