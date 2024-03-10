<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;

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
    return view('welcome');
});

// User routes
Route::post('/api/register', [UserController::class, 'register']);
Route::post('/api/login', [UserController::class, 'login']);

// Customer routes
Route::post('/api/customers/save', [CustomerController::class, 'save']);
Route::get('/api/customers/records', [CustomerController::class, 'records']);
Route::put('/api/customers/update/{id}', [CustomerController::class, 'update']);
Route::delete('/api/customers/delete/{id}', [CustomerController::class, 'delete']);
