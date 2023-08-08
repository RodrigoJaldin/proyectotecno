<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AsistenciaController;
use App\Http\Controllers\ContratoController;
use App\Http\Controllers\DocumentoController;
use App\Http\Controllers\HorarioController;
use App\Http\Controllers\HorarioUserController;
use App\Http\Controllers\LicenciaController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RotacionController;
use App\Http\Controllers\SucursalController;
use App\Http\Controllers\TurnoExtraController;
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
    return view('auth.login');
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
Route::get('/Gerente', [UserController::class, 'gerente'])->name('gerente')->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('/JefeCocina', [UserController::class, 'jefesCocina'])->name('jefesCocina')->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('/jefesCaja', [UserController::class, 'jefesCaja'])->name('jefesCaja')->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('/jefesAlmacen', [UserController::class, 'jefesAlmacen'])->name('jefesAlmacen')->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('/encargadosPlancha', [UserController::class, 'encargadosPlancha'])->name('encargadosPlancha')->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('/auxiliaresCocina', [UserController::class, 'auxiliaresCocina'])->name('auxiliaresCocina')->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('/cajeros', [UserController::class, 'cajeros'])->name('cajeros')->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('/limpieza', [UserController::class, 'limpieza'])->name('limpieza')->middleware(['auth', 'gerente', 'registrar.visita']);


Route::resource('user', UserController::class)->middleware(['auth', 'gerente', 'registrar.visita']);
Route::get('/{user_id}/horario', [HorarioUserController::class, 'showUserHorarios'])->name('horario_user.showUserHorarios')->middleware(['auth', 'gerente']);


//****************** G R A F I C O S ***************** */.
Route::get('/graficovisita', [VisitaController::class, 'generarGrafico'])->name('graficovisita')->middleware(['auth', 'gerente']);
Route::get('/graficolicencia', [LicenciaController::class, 'licenciasPorUsuario'])->middleware(['auth', 'gerente']);
Route::get('/graficoasistencia', [AsistenciaController::class, 'asistenciaPorUsuarioAutenticado'])->middleware(['auth']);
Route::get('/graficonomina', [UserController::class, 'graficoNominas'])->name('graficoNominas')->middleware(['auth', 'gerente']);


// Rutas para Contratos
Route::get('/contratos', [ContratoController::class, 'index'])->name('contrato.index')->middleware('registrar.visita.contrato');
Route::get('/contratos/create', [ContratoController::class, 'create'])->name('contratos.create')->middleware(['auth', 'gerente']);
Route::post('/contratos', [ContratoController::class, 'store'])->name('contratos.store')->middleware(['auth', 'gerente']);
Route::get('/contratos/{contrato}', [ContratoController::class, 'show'])->name('contratos.show')->middleware(['auth', 'gerente']);
Route::get('/contratos/{contrato}/edit', [ContratoController::class, 'edit'])->name('contratos.edit')->middleware(['auth', 'gerente']);
Route::put('/contratos/{contrato}', [ContratoController::class, 'update'])->name('contratos.update')->middleware(['auth', 'gerente']);
Route::delete('/contratos/{contrato}', [ContratoController::class, 'destroy'])->name('contratos.destroy')->middleware(['auth', 'gerente']);


Route::get('/turnos_extra', [TurnoExtraController::class, 'index'])->name('turnosExtra.index')->middleware('auth','gerente','registrar.visita.turno');
Route::get('/turnos_extra/create', [TurnoExtraController::class, 'create'])->name('turnosExtra.create')->middleware(['auth', 'gerente']);
Route::post('/turnos_extra', [TurnoExtraController::class, 'store'])->name('turnosExtra.store')->middleware(['auth', 'gerente']);
Route::get('/turnos_extra/{turnoExtra}', [TurnoExtraController::class, 'show'])->name('turnosExtra.show')->middleware(['auth', 'gerente']);
Route::get('/turnos_extra/{turnoExtra}/edit', [TurnoExtraController::class, 'edit'])->name('turnosExtra.edit')->middleware(['auth', 'gerente']);
Route::put('/turnos_extra/{turnoExtra}', [TurnoExtraController::class, 'update'])->name('turnosExtra.update')->middleware(['auth', 'gerente']);
Route::delete('/turnos_extra/{turnoExtra}', [TurnoExtraController::class, 'destroy'])->name('turnosExtra.destroy')->middleware(['auth', 'gerente']);

Route::resource('/rol', RolController::class)->middleware(['auth', 'registrar.visita.rol', 'gerente']);
Route::resource('/licencia', LicenciaController::class)->middleware(['auth','registrar.visita.licencia']);
Route::resource('/horario', HorarioController::class)->middleware(['auth','registrar.visita.horario', 'gerente']);
Route::resource('/horario_user', HorarioUserController::class)->middleware(['auth']);
Route::resource('/sucursal', SucursalController::class)->middleware(['auth', 'registrar.visita.sucursal', 'gerente']);
Route::resource('/documento', DocumentoController::class)->middleware(['auth', 'registrar.visita.documento']);
Route::resource('/asistencia', AsistenciaController::class)->middleware(['auth','registrar.visita.asistencia']);
Route::resource('/rotacion', RotacionController::class)->middleware(['auth', 'gerente','registrar.visita.rotacion']);


Route::post('/registrar-asistencia-llegada', [AsistenciaController::class, 'registrarAsistenciaLlegada'])->name('registrarAsistenciaLlegada')->middleware(['auth']);
Route::post('/registrar-asistencia-salida', [AsistenciaController::class, 'registrarAsistenciaSalida'])->name('registrarAsistenciaSalida')->middleware(['auth']);
Route::post('/asignarHorario', [HorarioUserController::class, 'store'])->name('asignarHorario')->middleware(['auth', 'gerente']);
Route::get('/user/{user}/calcular-nomina', [UserController::class, 'calcularNomina'])
    ->name('users.calcularNomina');


Route::get('/nomina/{user_id}', [UserController::class, 'showNomina'])->name('nomina.show')->middleware(['auth', 'gerente']);;

Route::get('/user/{userId}/horarios', [HorarioUserController::class, 'showHorariosAsignados'])->name('showHorariosAsignados')->middleware(['auth']);
Route::get('/{user_id}', [HorarioUserController::class, 'showUserHorarios'])->name('showUserHorarios')->middleware(['auth', 'gerente']);

Route::post('myurl',[SearchController::class,'show']);


Route::get('/{sucursal_id}', [SucursalController::class, 'trabajadoresPorSucursal'])
    ->name('sucursal.trabajadores')->middleware(['auth']);


