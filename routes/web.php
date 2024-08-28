<?php

use App\Http\Controllers\AideSocialeController;
use App\Http\Controllers\DonateurController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ParticiperController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;

Route::get('/', [HomeController::class, 'index'])->name('root');

Route::get('/donators', [DonateurController::class, 'index']);
Route::post('/donators', [DonateurController::class, 'store']);
Route::post('/participers', [ParticiperController::class, 'store']);
Route::get('/donators/create/{numaid}', [DonateurController::class, 'create'])->name('create_donator');

Route::get('/admin', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
});

Route::resource('/users', UserController::class);

Route::post('/assignRoles/{role}/{user}', [RoleController::class, 'assignRoles'])->name('assign_role');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
