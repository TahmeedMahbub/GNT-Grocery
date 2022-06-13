<?php

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




Route::get ('/', 'GroceryController@index')->name('index');
Route::get ('/addProduct', 'GroceryController@addProduct')->name('addProduct');
Route::get ('/allProduct', 'GroceryController@allProduct')->name('allProduct');
Route::post ('/addProduct', 'GroceryController@addProductSub')->name('addProductSub');
Route::get ('/sellProduct', 'GroceryController@sellProduct')->name('sellProduct');
Route::post ('/sellProduct', 'GroceryController@sellProductSub')->name('sellProductSub');
Route::post ('/sellProductConfirm', 'GroceryController@sellProductConfirm')->name('sellProductConfirm');
Route::get ('/invoices', 'GroceryController@invoices')->name('invoices');
Route::get ('/invoicesDataTable', 'GroceryController@invoicesDataTable')->name('invoicesDataTable');
Route::get ('/invoice-details/{id}', 'GroceryController@invoicesDetails')->name('invoice.details');
Route::get ('/invoiceView', 'GroceryController@invoiceView')->name('invoiceView');
Route::get ('/invoiceView/{id}', 'GroceryController@invoiceViewId')->name('invoiceViewId');
Route::get ('/stockout', 'GroceryController@stockout')->name('stockout');
Route::get ('/restockProduct', 'GroceryController@restockProduct')->name('restockProduct');
Route::post ('/restockProductSub', 'GroceryController@restockProductSub')->name('restockProductSub');

Route::get ('/dataTable', 'GroceryController@dataTable')->name('dataTable');