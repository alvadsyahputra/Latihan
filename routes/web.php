<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScanController;


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

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get("scan", [ScanController::class,'index'])->name('scan.index');
Route::get("scan/create", [ScanController::class,'create'])->name('scan.create');
Route::post("scan", [scanController::class,'store'])->name('scan.store');
Route::get("scan/{id}/edit", [ScanController::class,'edit'])->name('scan.edit');
Route::delete("scan/{scan}", [ScanController::class,'destroy'])->name('scan.destroy');
Route::put("scan/{scan}", [ScanController::class,'update'])->name('scan.update');
