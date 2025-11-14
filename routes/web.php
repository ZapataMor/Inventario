<?php

use Illuminate\Support\Facades\Route;
use Laravel\Fortify\Features;
use Livewire\Volt\Volt;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->get('/', function () {
    return redirect()->route('dashboard');
})->name('home');

/* Ruta opcional si algún día quieres volver a mostrar la vista de welcome
Route::get('/', function () {
    return view('welcome');
})->name('home');
*/

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
    | CRUD de Usuarios
    |--------------------------------------------------------------------------
    */

    // Rutas para gestionar usuarios (index, create, edit, delete, etc)
    Route::resource('users', UserController::class);

});
