<?php

use App\Http\Controllers\AirtimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\bydata;
use App\Http\Controllers\FundController;
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

Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
Route::get('airtime', [AuthController::class, 'airtime'])->name('airtime');
Route::get('select', [AuthController::class, 'select'])->name('select');
Route::post('buyairtime', [AirtimeController::class, 'airtime'])->name('buyairtime');
Route::post('buydata', [AuthController::class, 'buydata'])->name('buydata');
Route::post('pre', [AuthController::class, 'pre'])->name('pre');
Route::post('bill', [Authcontroller::class, 'airtime'])->name('bill');
Route::post('data', [bydata::class, 'data'])->name('data');
Route::get('fund', [FundController::class, 'fund'])->name('fund');
Route::get('tran/{reference}', [FundController::class, 'tran'])->name('tran');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');


