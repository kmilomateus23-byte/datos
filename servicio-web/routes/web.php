<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\Admin\AdminReservaController;
use Illuminate\Support\Facades\Route;

// Página principal (Landing)
Route::get('/', function () {
    return view('welcome');
});

// Dashboard dinámico según el rol (todos los usuarios autenticados)
Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Perfil de usuario (protected)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// -------------------
// RESERVAS - USUARIO NORMAL
// -------------------
Route::middleware(['auth'])->group(function () {
    Route::get('/reservas', [ReservaController::class, 'index'])->name('reservas.index');
    Route::get('/reservas/create', [ReservaController::class, 'create'])->name('reservas.create');
    Route::post('/reservas', [ReservaController::class, 'store'])->name('reservas.store');
    Route::delete('/reservas/{reserva}', [ReservaController::class, 'destroy'])->name('reservas.destroy');
});

// ---------------------
// ADMIN - GESTIÓN RESERVAS
// ---------------------
Route::middleware(['auth', \App\Http\Middleware\IsAdmin::class])
    ->prefix('admin')
    ->group(function () {
        // Dashboard admin
        Route::get('/dashboard', [DashboardController::class, 'admin'])->name('admin.dashboard');

        // CRUD completo de reservas admin
        Route::get('/reservas', [AdminReservaController::class, 'index'])->name('admin.reservas.index');
        Route::get('/reservas/{reserva}', [AdminReservaController::class, 'show'])->name('admin.reservas.show');
        Route::get('/reservas/{reserva}/edit', [AdminReservaController::class, 'edit'])->name('admin.reservas.edit');
        Route::put('/reservas/{reserva}', [AdminReservaController::class, 'update'])->name('admin.reservas.update');
        Route::patch('/reservas/{reserva}/estado', [AdminReservaController::class, 'updateEstado'])->name('admin.reservas.updateEstado');
        Route::delete('/reservas/{reserva}', [AdminReservaController::class, 'destroy'])->name('admin.reservas.destroy');

        // Otros endpoints de prueba
        Route::get('/prueba', [\App\Http\Controllers\TestController::class, 'index']);
    });

// Autenticación (login/register/logout)
require __DIR__.'/auth.php';
