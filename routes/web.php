<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Route::post('/auth',[
    \App\Http\Controllers\Auth\LoginController::class
    , '__invoke'
])->name('login');

Route::get('leads', [
    \App\Http\Controllers\Lead\IndexLeadController::class
    , '__invoke'
]);

Route::get('lead/{id}', [
    \App\Http\Controllers\Lead\ShowLeadController::class
    , '__invoke'
]);

Route::post('lead', [
    \App\Http\Controllers\Lead\CreateLeadController::class
    , '__invoke'
]);

