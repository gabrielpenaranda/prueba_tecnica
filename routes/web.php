<?php

use App\Http\Controllers\ProfileController;
/* use App\Http\Controllers\CompanyController;
use App\Http\Controllers\UserController; */
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/* Route::middleware('auth')->prefix('companies')->group(function() {
    Route::get('', [CompanyController::class, 'index'])->name('companies-index');
    Route::get('create', [CompanyController::class, 'create'])->name('companies-create');
    Route::post('store', [CompanyController::class, 'store'])->name('companies-store');
    Route::get('edit/{company}', [CompanyController::class, 'edit'])->name('companies-esit');
    Route::put('update/{company}', [CompanyController::class, 'update'])->name('companies-update');
    Route::get('show', [CompanyController::class, 'show'])->name('companies-show');
    Route::delete('destroy/{company', [CompanyController::class, 'destroy'])->name('companies-destroy');
});

Route::middleware('auth')->prefix('users')->group(function () {
    Route::get('', [UserController::class, 'index'])->name('users-index');
    Route::get('create', [UserController::class, 'create'])->name('users-create');
    Route::post('store', [UserController::class, 'store'])->name('users-store');
    Route::get('edit/{user}', [UserController::class, 'edit'])->name('users-esit');
    Route::put('update/{user}', [UserController::class, 'update'])->name('users-update');
    Route::get('show', [UserController::class, 'show'])->name('users-show');
    Route::delete('destroy/{user', [UserController::class, 'destroy'])->name('users-destroy');
}); */

require __DIR__.'/auth.php';
