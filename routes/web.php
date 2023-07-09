<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SmartphoneController;

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

Route::get('/', [SmartphoneController::class, 'index'])->name('smartphone.index');

// Route::resource('smartphones', [SmartphoneController::class]);
Route::get('/smartphones', [SmartphoneController::class, 'index'])->name('smartphones.index');
Route::get('/saw', [SmartphoneController::class, 'calculateSAW'])->name('calculateSAW');

Route::get('/hasil', [SmartphoneController::class, 'calculateRanking'])->name('calculate');


Route::get('/smartphones/{id}/profile-matching', [SmartphoneController::class, 'calculateProfileMatching'])->name('smartphones.profile_matching');
