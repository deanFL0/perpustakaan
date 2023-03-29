<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProgramKegiatanController;
use JetBrains\PhpStorm\Deprecated;

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

//redirect route / to login
Route::get('/', function () {
    return redirect()->route('login');
});
Route::get('/home', function () {
    return redirect()->route('dashboard');
})->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::post('/login', [LoginController::class, 'authenticate'])->name('login.authenticate');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard')->middleware('auth');

Route::get('/prokeg', [ProgramKegiatanController::class, 'index'])->name('prokeg')->middleware('auth');
Route::get('/prokeg/create', [ProgramKegiatanController::class, 'create'])->name('prokeg.create')->middleware('auth');
Route::post('/prokeg/store', [ProgramKegiatanController::class, 'store'])->name('prokeg.store')->middleware('auth');
Route::get('/prokeg/edit/{id}', [ProgramKegiatanController::class, 'edit'])->name('prokeg.edit')->middleware('auth');
Route::post('/prokeg/update', [ProgramKegiatanController::class, 'update'])->name('prokeg.update')->middleware('auth');
Route::delete('/prokeg/destroy/{id}', [ProgramKegiatanController::class, 'destroy'])->name('prokeg.destroy')->middleware('auth');


