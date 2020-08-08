<?php

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
    return view('firstPage');
});


Route::resource('/userlogin','LoginController');

Route::resource('/admin','AdminPageController');

Route::resource('/admin-profile','AdminProfileController');

Route::resource('/admin-drivers','AdminDriversController');

Route::resource('/admin-invoices','AdminInvoicesController');
Route::resource('/admin-income','AdminIncomeController');
