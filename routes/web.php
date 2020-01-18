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

Route::view('/', 'welcome');
    Auth::routes();

    Route::get('/login/company', 'Auth\LoginController@showCompanyLoginForm')->name('company.login.show');
    Route::get('/login/supplier', 'Auth\LoginController@showSupplierLoginForm')->name('supplier.login.show');
    Route::get('/register/company', 'Auth\RegisterController@showCompanyRegisterForm')->name('company.register.show');
    Route::get('/register/supplier', 'Auth\RegisterController@showSupplierRegisterForm')->name('supplier.register.show');

    Route::post('/login/company', 'Auth\LoginController@companyLogin')->name('company.login.attempt');
    Route::post('/login/supplier', 'Auth\LoginController@supplierLogin')->name('supplier.login.attempt');
    Route::post('/register/company', 'Auth\RegisterController@createCompany')->name('company.store');
    Route::post('/register/supplier', 'Auth\RegisterController@createSupplier')->name('supplier.store');


    Route::prefix('dashboard')->group(function () {
        Route::resource('products', 'Backend\ProductController');
    });

    Route::view('/home', 'home')->middleware('auth');
    Route::view('/company', 'home');
    Route::view('/supplier', 'home');
