<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth.login');
});



Auth::routes();

//Auth::routes(['register'=> false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('invoices', \App\Http\Controllers\InvoicesController::class);
Route::resource('sections', \App\Http\Controllers\SectionsController::class);
Route::resource('products', \App\Http\Controllers\ProductsController::class);
Route::resource('InvoiceAttachments', 'App\Http\Controllers\InvoiceAttachmentsController');

Route::get('/section/{id}', 'App\Http\Controllers\InvoicesController@getproducts');
Route::get('/InvoicesDetails/{id}', 'App\Http\Controllers\InvoicesDetailsController@edit');

Route::get('download/{invoice_number}/{file_name}', 'App\Http\Controllers\InvoicesDetailsController@get_file');

Route::get('View_file/{invoice_number}/{file_name}', 'App\Http\Controllers\InvoicesDetailsController@open_file');

Route::get('/edit_invoice/{id}', 'App\Http\Controllers\InvoicesController@edit');

Route::get('/Status_show/{id}', 'App\Http\Controllers\InvoicesController@show')->name('Status_show');


Route::post('/Status_Update/{id}', 'App\Http\Controllers\InvoicesController@Status_Update')->name('Status_Update');

Route::get('Print_invoice/{id}','App\Http\Controllers\InvoicesController@Print_invoice');

Route::get('Invoice_Paid','App\Http\Controllers\InvoicesController@Invoice_Paid');

Route::get('Invoice_UnPaid','App\Http\Controllers\InvoicesController@Invoice_UnPaid');

Route::get('Invoice_Partial','App\Http\Controllers\InvoicesController@Invoice_Partial');

Route::resource('Archive', 'App\Http\Controllers\InvoiceAchiveController');

// Route::get('export_invoices','App\Http\Controllers\InvoicesController@export');


Route::post('delete_file', 'App\Http\Controllers\InvoicesDetailsController@destroy')->name('delete_file');


Route::group(['middleware' => ['auth']], function() {
    Route::resource('users', 'App\Http\Controllers\UserController');
    Route::resource('roles', 'App\Http\Controllers\RoleController');
});

Route::get('invoices_report','App\Http\Controllers\Invoices_ReportController@index');

Route::post('Search_invoices', 'App\Http\Controllers\Invoices_ReportController@Search_invoices');

Route::get('customers_report', 'App\Http\Controllers\Customers_ReportController@index')->name("customers_report");

Route::post('Search_customers', 'App\Http\Controllers\Customers_ReportController@Search_customers');

Route::get('MarkAsRead_all','App\Http\Controllers\InvoicesController@MarkAsRead_all')->name('MarkAsRead_all');

Route::get('unreadNotifications_count', 'App\Http\Controllers\InvoicesController@unreadNotifications_count')->name('unreadNotifications_count');

Route::get('unreadNotifications', 'App\Http\Controllers\InvoicesController@unreadNotifications')->name('unreadNotifications');


Route::get('/{page}', 'App\Http\Controllers\AdminController@index');




