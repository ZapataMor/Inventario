<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\SaleDetailController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

/*
|--------------------------------------------------------------------------
| Rutas protegidas por autenticación
|--------------------------------------------------------------------------
*/

Route::middleware(['auth'])->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Ajustes del usuario (Fortify + Volt)
    |--------------------------------------------------------------------------
    */

    Route::redirect('settings', 'settings/profile');

    Volt::route('settings/profile', 'settings.profile')
        ->name('profile.edit');

    Volt::route('settings/password', 'settings.password')
        ->name('user-password.edit');

    Volt::route('settings/appearance', 'settings.appearance')
        ->name('appearance.edit');

    Volt::route('settings/two-factor', 'settings.two-factor')
        ->middleware(
            when(
                Features::canManageTwoFactorAuthentication()
                    && Features::optionEnabled(Features::twoFactorAuthentication(), 'confirmPassword'),
                ['password.confirm'],
                [],
            )
        )
        ->name('two-factor.show');

    /*
    |--------------------------------------------------------------------------
    | CRUD de Usuarios - Solo Administradores
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin'])->group(function () {
        Route::resource('users', UserController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | CRUD de Productos - Admin y Empleados
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin,empleado'])->group(function () {
        Route::resource('products', ProductController::class);
    });

    /*
    |--------------------------------------------------------------------------
    | CRUD de Ventas - Admin y Empleados
    |--------------------------------------------------------------------------
    */
    Route::middleware(['role:admin,empleado'])->group(function () {
        Route::resource('sales', SaleController::class)->except(['edit', 'update', 'destroy']);
        
        // Solo admin puede eliminar detalles de venta
        Route::middleware(['role:admin'])->group(function () {
            Route::delete('sale-details/{saleDetail}', [SaleDetailController::class, 'destroy'])
                ->name('sale-details.destroy');
        });
    });

});