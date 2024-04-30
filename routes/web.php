<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;
use App\Models\Customers;
use App\Http\Controllers\CustomerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('home');
});

// Route::get('/register',[RegistrationController::class,'index']);
// Route::post('/register',[RegistrationController::class,'register']);
Route::get('/customer/create',[CustomerController::class,'create']);
Route::get('/customer/view',[CustomerController::class,'view']);
Route::get('/customer/delete/{id}',[CustomerController::class,'delete']);
Route::get('/customer/edit/{id}',[CustomerController::class,'edit']);
Route::post('/customer/update/{id}',[CustomerController::class,'update']);
Route::match(['get', 'post'], '/customer', [CustomerController::class, 'store']);
