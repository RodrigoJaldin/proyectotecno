<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\HorarioUserController;
use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\UserController;
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
Route::get('user/Gerente', [UserController::class, 'gerente'])->name('gerente')->middleware(['auth']);
Route::get('user/JefeCocina', [UserController::class, 'jefesCocina'])->name('jefesCocina')->middleware(['auth']);
Route::get('user/jefesCaja', [UserController::class, 'jefesCaja'])->name('jefesCaja')->middleware(['auth']);
Route::get('user/jefesAlmacen', [UserController::class, 'jefesAlmacen'])->name('jefesAlmacen')->middleware(['auth']);
Route::get('user/encargadosPlancha', [UserController::class, 'encargadosPlancha'])->name('encargadosPlancha')->middleware(['auth']);
Route::get('user/auxiliaresCocina', [UserController::class, 'auxiliaresCocina'])->name('auxiliaresCocina')->middleware(['auth']);
Route::get('user/cajeros', [UserController::class, 'cajeros'])->name('cajeros')->middleware(['auth']);
Route::get('user/limpieza', [UserController::class, 'limpieza'])->name('limpieza')->middleware(['auth']);

Route::resource('user', UserController::class)->middleware(['auth']);


Route::resource('licencia', LicenciaController::class)->middleware(['auth']);
Route::resource('horario', HorarioController::class)->middleware(['auth']);
Route::resource('horario_user', HorarioUserController::class)->middleware(['auth']);
Route::resource('sucursal', SucursalController::class)->middleware(['auth']);
Route::resource('rol', RolController::class)->middleware(['auth']);
Route::resource('documento', DocumentoController::class)->middleware(['auth']);
Route::resource('asistencia', AsistenciaController::class)->middleware(['auth']);

Route::post('/registrar-asistencia-llegada', [AsistenciaController::class, 'registrarAsistenciaLlegada'])->name('registrarAsistenciaLlegada')->middleware(['auth']);
Route::post('/registrar-asistencia-salida', [AsistenciaController::class, 'registrarAsistenciaSalida'])->name('registrarAsistenciaSalida')->middleware(['auth']);
Route::post('/asignarHorario', [HorarioUserController::class, 'store'])->name('asignarHorario')->middleware(['auth']);
Route::get('/user/{userId}/horarios', [HorarioUserController::class, 'showHorariosAsignados'])->name('showHorariosAsignados')->middleware(['auth']);
