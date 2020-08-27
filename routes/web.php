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
    // return view('userLogin');
    if (auth()->user()) {
        if (auth()->user()->company_id == 0) {
            return view('Admin/adminPage');
        } elseif (auth()->user()->company_id != 0) {
            return view('Driver/mainPage');
        }
    } else
        return view('userLogin');
});
Route::resource('/company-works', 'CompanyWorksController');
Route::resource('/driver', 'DriverPageController');
Route::resource('/userlogin', 'LoginController');
Route::resource('/admin', 'AdminPageController');
Route::resource('/admin-profile', 'AdminProfileController');
Route::resource('/admin-drivers', 'AdminDriversController');
Route::resource('/admin-invoices', 'AdminInvoicesController');
Route::resource('/admin-income', 'AdminIncomeController');
Route::get('/register', 'RegistrationController@create');
Route::post('register', 'RegistrationController@store');
Route::get('/login', 'LoginController@create');
Route::post('/login', 'LoginController@store');
Route::get('/logout', 'LoginController@destroy');

