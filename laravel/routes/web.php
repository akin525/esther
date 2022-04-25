<?php

use App\Http\Controllers\AirtimeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\bydata;
use App\Http\Controllers\EleController;
use App\Http\Controllers\FundController;
use App\Http\Controllers\TvController;
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
Route::get('listtv', [TvController::class, 'listtv'])->name('listtv');
Route::get('tv', [TvController::class, 'tv'])->name('tv');
Route::get('selecttv', [TvController::class, 'process'])->name('selecttv');
Route::post('tvp', [TvController::class, 'paytv'])->name('tvp');
Route::post('verifytv', [TvController::class, 'verifytv'])->name('verifytv');
Route::post('payelect', [EleController::class, 'payelect'])->name('payelect');
Route::post('verifye', [EleController::class, 'verifyelect'])->name('verifye');
Route::get('elect', [EleController::class, 'electric'])->name('elect');
Route::post('pre', [AuthController::class, 'pre'])->name('pre');
Route::post('bill', [Authcontroller::class, 'airtime'])->name('bill');
Route::post('data', [bydata::class, 'data'])->name('data');
Route::get('fund', [FundController::class, 'fund'])->name('fund');
Route::get('tran/{reference}', [FundController::class, 'tran'])->name('tran');
Route::get('signout', [AuthController::class, 'signOut'])->name('signout');


