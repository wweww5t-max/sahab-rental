<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContractController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\VehicleController;

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Redirect root
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return redirect('/contracts');
});

/*
|--------------------------------------------------------------------------
| Protected Routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', function () {
        return 'Welcome sultan 🔥';
<h1>Dashboard</h1>

<p>Welcome {{ auth()->user()->name }}</p>

<ul>
    <li><a href="/contracts">Contracts</a></li>
    <li><a href="/customers">Customers</a></li>
    <li><a href="/vehicles">Vehicles</a></li>
</ul>
    });

    Route::middleware(['role:manager|accountant'])->group(function () {
        Route::resource('contracts', ContractController::class);
        Route::resource('customers', CustomerController::class);
        Route::resource('vehicles', VehicleController::class);

        Route::get('/contracts/{contract}/pdf', [ContractController::class, 'pdf'])
            ->name('contracts.pdf');
    });

    Route::middleware(['role:manager'])->group(function () {
        Route::patch('/contracts/{contract}/close', [ContractController::class, 'close'])
            ->name('contracts.close');
    });
});