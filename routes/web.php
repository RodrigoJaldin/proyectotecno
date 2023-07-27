<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\HorarioUserController;
use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RotacionController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\VisitaController;

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
    'verified',
    'registrar.visita.home'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
Route::get('Gerente', [UserController::class, 'gerente'])->name('gerente')->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('JefeCocina', [UserController::class, 'jefesCocina'])->name('jefesCocina')->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('jefesCaja', [UserController::class, 'jefesCaja'])->name('jefesCaja')->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('jefesAlmacen', [UserController::class, 'jefesAlmacen'])->name('jefesAlmacen')->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('encargadosPlancha', [UserController::class, 'encargadosPlancha'])->name('encargadosPlancha')->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('auxiliaresCocina', [UserController::class, 'auxiliaresCocina'])->name('auxiliaresCocina')->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('cajeros', [UserController::class, 'cajeros'])->name('cajeros')->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('limpieza', [UserController::class, 'limpieza'])->name('limpieza')->middleware(['auth', 'gerente', 'registrar.visita']);

Route::resource('user', UserController::class)->middleware(['auth', 'gerente', 'registrar.visita']);
Route::resource('rol', RolController::class)->middleware(['auth', 'registrar.visita.rol', 'gerente']);


Route::resource('licencia', LicenciaController::class)->middleware(['auth','registrar.visita.licencia', 'gerente']);
Route::resource('horario', HorarioController::class)->middleware(['auth','registrar.visita.horario', 'gerente']);
Route::resource('horario_user', HorarioUserController::class)->middleware(['auth']);
Route::resource('sucursal', SucursalController::class)->middleware(['auth', 'registrar.visita.sucursal', 'gerente']);
Route::resource('documento', DocumentoController::class)->middleware(['auth', 'registrar.visita.documento']);
Route::resource('asistencia', AsistenciaController::class)->middleware(['auth', 'registrar.visita.asistencia']);
Route::resource('licencia', LicenciaController::class)->middleware(['auth','registrar.visita.licencia', 'gerente']);
Route::resource('rotacion', RotacionController::class)->middleware(['auth', 'gerente']);

Route::post('/registrar-asistencia-llegada', [AsistenciaController::class, 'registrarAsistenciaLlegada'])->name('registrarAsistenciaLlegada')->middleware(['auth']);
Route::post('/registrar-asistencia-salida', [AsistenciaController::class, 'registrarAsistenciaSalida'])->name('registrarAsistenciaSalida')->middleware(['auth']);
Route::post('/asignarHorario', [HorarioUserController::class, 'store'])->name('asignarHorario')->middleware(['auth']);
Route::get('/user/{userId}/horarios', [HorarioUserController::class, 'showHorariosAsignados'])->name('showHorariosAsignados')->middleware(['auth']);
Route::get('/{user_id}', [HorarioUserController::class, 'showUserHorarios'])->name('showUserHorarios')->middleware(['auth']);

Route::post('myurl',[SearchController::class,'show']);