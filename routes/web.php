<?php

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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::resource('user', UserController::class)->middleware(['auth']);
Route::resource('licencia', LicenciaController::class)->middleware(['auth']);
Route::resource('asistencia', AsistenciaController::class)->middleware(['auth']);
Route::resource('horario', HorarioController::class)->middleware(['auth']);
Route::resource('horario_user', HorarioUserController::class)->middleware(['auth']);
Route::resource('sucursal', SucursalController::class)->middleware(['auth']);
Route::resource('rol', RolController::class)->middleware(['auth']);
Route::resource('documento', DocumentoController::class)->middleware(['auth']);
