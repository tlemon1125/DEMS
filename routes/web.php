<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

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
    return Redirect::route('login');
});

// Route::get('/login', [LoginController::class, 'show']);

Route::middleware('guest')->group(function() {
    Route::get('login', [LoginController::class, 'show'])->name('login');

    Route::post('login', [LoginController::class, 'authenticate']);
    
    Route::get('forgotpassword', function() {
        return Inertia::render('Auth/ForgotPassword');
    })->name('password.request');
});

Route::middleware(['auth', 'roles:0'])->group(function() {
    Route::get('home', [StudentController::class, 'dashboard'])->name('student.dashboard');

    Route::post('logout', [LoginController::class, 'logout'])->name('logout');
});



