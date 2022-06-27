<?php


use App\Product;
use App\Invoice;
use App\SoldItem;

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




Route::get ('/admin/layout', 'GroceryController@adminLayout')->name('adminLayout');

Route::get ('/', 'GroceryController@allProduct')->name('allProduct');
Route::get ('/allProduct', 'GroceryController@allProduct')->name('allProduct');
Route::get ('/addProduct', 'GroceryController@addProduct')->name('addProduct');
Route::post ('/addProduct', 'GroceryController@addProductSub')->name('addProductSub');
Route::get ('/sellProduct', 'GroceryController@sellProduct')->name('sellProduct');
Route::post ('/sellProduct', 'GroceryController@sellProductSub')->name('sellProductSub');
Route::post ('/sellProductConfirm', 'GroceryController@sellProductConfirm')->name('sellProductConfirm');
Route::get ('/invoices', 'GroceryController@invoices')->name('invoices');
Route::get ('/invoicesDataTable', 'GroceryController@invoicesDataTable')->name('invoicesDataTable');
Route::get ('/invoice-details/{id}', 'GroceryController@invoicesDetails')->name('invoice.details');
Route::get ('/invoiceView', 'GroceryController@invoiceView')->name('invoiceView');
Route::get ('/invoiceView/{id}', 'GroceryController@invoiceViewId')->name('invoiceViewId');
Route::get ('/warning', 'GroceryController@warning')->name('warning');
Route::get ('/restockProduct', 'GroceryController@restockProduct')->name('restockProduct');
Route::post ('/restockProductSub', 'GroceryController@restockProductSub')->name('restockProductSub');

Route::get ('/invoice-details/{id}', 'GroceryController@invoicesDetails')->name('invoice.details');
Route::get('/downloadInvoice/{id}', 'GroceryController@downloadInvoice')->name('downloadInvoice');
Route::get('/viewInvoice/{id}', 'GroceryController@viewInvoice')->name('viewInvoice');

Route::get ('/stat', 'GroceryController@stat')->name('stat');
Route::get ('/downloadChart', 'GroceryController@downloadChart')->name('downloadChart');
Route::get ('/downloadCSV', 'GroceryController@downloadCSV')->name('downloadCSV');


Route::get ('/signup', 'GroceryController@signup')->name('signup');
Route::post ('/signup', 'GroceryController@signupSub')->name('signupSub');

Route::get ('/signin', 'GroceryController@signin')->name('signin');
Route::post ('/signin', 'GroceryController@signinSub')->name('signinSub');

Route::get ('/signout', 'GroceryController@signout')->name('signout');

Route::get ('/verify/{id}', 'GroceryController@verify')->name('verify');
Route::post ('/verify', 'GroceryController@verifySub')->name('verifySub');
Route::get ('/verifyMail/{id}/{otp}', 'GroceryController@verifyMail')->name('verifyMail');
Route::get ('/deleteVerifyMail/{id}', 'GroceryController@deleteVerifyMail')->name('deleteVerifyMail');