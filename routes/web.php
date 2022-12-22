<?php
use App\Http\Controllers\HomeController;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
//Auth::routes(['register' => false]);

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::resource('/invoices', 'App\Http\Controllers\InvoicesController');

Route::resource('/sections', 'App\Http\Controllers\SectionsController');

Route::resource('/products', 'App\Http\Controllers\ProductsController');

Route::resource('/mixes', 'App\Http\Controllers\MixesController');

Route::resource('/mixtures', 'App\Http\Controllers\MixturesController');

Route::resource('/stock', 'App\Http\Controllers\StocksController');

Route::resource('/outgoings', 'App\Http\Controllers\OutgoingsController');

Route::resource('/productions', 'App\Http\Controllers\ProductionsController');

Route::resource('/addproduction', 'App\Http\Controllers\addproductionController');

Route::resource('/incomings', 'App\Http\Controllers\IncomingsController');

Route::resource('/Manufacturings', 'App\Http\Controllers\ManufacturingsController');

Route::resource('InvoiceAttachments', 'App\Http\Controllers\InvoiceAttachmentsController');

Route::resource('report', 'App\Http\Controllers\ReportController');

Route::resource('sells', 'App\Http\Controllers\SellsController');

Route::resource('Expenses', 'App\Http\Controllers\ExpensesController');



Route::get('/InvoicesDetails/{id}', 'App\Http\Controllers\InvoicesDetailsController@edit');

Route::get('/sectionDetails/{id}', 'App\Http\Controllers\sectionDetailsController@edit');

Route::get('/manufacturingDetails/{id}', 'App\Http\Controllers\manufacturingDetailsController@edit');

Route::get('/mixDetails/{id}', 'App\Http\Controllers\mixDetailsController@edit');

Route::get('/section/{id}', 'App\Http\Controllers\InvoicesController@getproducts');

Route::get('/mixture/{id}', 'App\Http\Controllers\MixturesController@getproducts');

Route::get('/getmix/{id}', 'App\Http\Controllers\MixturesController@getmixes');



Route::get('download/{invoice_number}/{file_name}', 'App\Http\Controllers\InvoicesDetailsController@get_file');

Route::get('View_file/{invoice_number}/{file_name}', 'App\Http\Controllers\InvoicesDetailsController@open_file');

Route::post('delete_file', 'App\Http\Controllers\InvoicesDetailsController@destroy')->name('delete_file');
// out
Route::get('download/{out_number}/{file_name}', 'App\Http\Controllers\OutgoingsController@get_file');

Route::get('View_file/{out_number}/{file_name}', 'App\Http\Controllers\OutgoingsController@open_file');
// in
Route::get('download/{out_number}/{file_name}', 'App\Http\Controllers\IncomingsController@get_file');

Route::get('View_file/{out_number}/{file_name}', 'App\Http\Controllers\IncomingsController@open_file');
// sell
Route::get('download/{number}/{file_name}', 'App\Http\Controllers\SellsController@get_file');

Route::get('View_file/{number}/{file_name}', 'App\Http\Controllers\SellsController@open_file');
// Expenses
Route::get('download/{number}/{file_name}', 'App\Http\Controllers\ExpensesController@get_file');

Route::get('View_file/{number}/{file_name}', 'App\Http\Controllers\ExpensesController@open_file');


Route::get('/edit_invoice/{id}', 'App\Http\Controllers\InvoicesController@edit');

Route::get('/edit_out/{id}', 'App\Http\Controllers\OutgoingsController@edit');

Route::get('/edit_in/{id}', 'App\Http\Controllers\IncomingsController@edit');

Route::get('/edit_sells/{id}', 'App\Http\Controllers\SellsController@edit');

Route::get('/edit_productions/{id}', 'App\Http\Controllers\ProductionsController@edit');

Route::get('/edit_Expenses/{id}', 'App\Http\Controllers\ExpensesController@edit');

Route::get('/Status_show/{id}', 'App\Http\Controllers\InvoicesController@show')->name('Status_show');

Route::post('/Status_Update/{id}', 'App\Http\Controllers\InvoicesController@Status_Update')->name('Status_Update');

Route::resource('Archive', 'App\Http\Controllers\InvoiceAchiveController');

Route::get('Invoice_Paid','App\Http\Controllers\InvoicesController@Invoice_Paid');

Route::get('Invoice_UnPaid','App\Http\Controllers\InvoicesController@Invoice_UnPaid');

Route::get('Invoice_Partial','App\Http\Controllers\InvoicesController@Invoice_Partial');

Route::get('Print_invoice/{id}','App\Http\Controllers\InvoicesController@Print_invoice');

Route::get('export_invoices', 'App\Http\Controllers\InvoicesController@export');

Route::group(['middleware' => ['auth']], function() {

Route::resource('roles','App\Http\Controllers\RoleController');

Route::resource('users','App\Http\Controllers\UserController');

});

Route::get('invoices_report', 'App\Http\Controllers\Invoices_Report@index');

Route::post('Search_invoices', 'App\Http\Controllers\Invoices_Report@Search_invoices');

Route::get('customers_report', 'App\Http\Controllers\Customers_Report@index')->name("customers_report");

Route::get('incoming_report', 'App\Http\Controllers\incoming_Report@index')->name("incoming_report");

Route::get('production_report', 'App\Http\Controllers\production_report@index')->name("production_report");

Route::get('manufacturing_report', 'App\Http\Controllers\manufacturing_report@index')->name("manufacturing_report");

Route::get('sells_report', 'App\Http\Controllers\sells_report@index')->name("sells_report");

Route::get('Expense_report', 'App\Http\Controllers\Expense_report@index')->name("Expense_report");

Route::post('Search_customers', 'App\Http\Controllers\Customers_Report@Search_customers');

Route::post('Search_incoming', 'App\Http\Controllers\Incoming_Report@Search_customers');

Route::post('Search_production', 'App\Http\Controllers\production_report@Search_customers');

Route::post('Search_manufacturing', 'App\Http\Controllers\manufacturing_report@Search_customers');

Route::post('Search_sells', 'App\Http\Controllers\sells_report@Search_customers');

Route::post('Search_Expense', 'App\Http\Controllers\Expense_report@Search_customers');

Route::post('Search', 'App\Http\Controllers\ReportController@search');

Route::get('MarkAsRead_all','App\Http\Controllers\InvoicesController@MarkAsRead_all')->name('MarkAsRead_all');

Route::get('unreadNotifications_count', 'App\Http\Controllers\InvoicesController@unreadNotifications_count')->name('unreadNotifications_count');

Route::get('unreadNotifications', 'App\Http\Controllers\InvoicesController@unreadNotifications')->name('unreadNotifications');



Route::get('/{page}', 'App\Http\Controllers\AdminController@index');
//Route::get('/{page}', 'AdminController@index');
































