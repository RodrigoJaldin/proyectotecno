<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Horario;
use App\Models\HorarioUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Obtener el ID del usuario logueado
        $userId = Auth::id();

        // Obtener el rol del usuario logueado
        $userRole = Auth::user()->rol->tipo_rol;

        if ($userRole === 'Gerente') {
            // Si el usuario logueado tiene el rol de "Gerente", mostramos todas las asistencias
            $asistencias = Asistencia::all();
        } else {
            // Si el usuario logueado tiene otro rol, mostramos solo sus asistencias
            $asistencias = Asistencia::where('id_user', $userId)->get();
        }

        $fechaActual = now()->toDateString();
        $horaActual = Carbon::now()->timezone('America/La_Paz')->toTimeString();
        return view('asistencia.index', compact('asistencias', 'fechaActual', 'horaActual'));
    }



    public function registrarAsistencia(Request $request)
    {
        $fechaActual = now()->toDateString(); // Obtener la fecha actual en formato yyyy-mm-dd
        $horaActual = Carbon::now()->timezone('America/La_Paz')->toTimeString(); // Obtener la hora actual en formato hh:mm:ss
        $user_id = auth()->user()->id;

        // Comprobar si el usuario ya tiene una asistencia registrada para la fecha actual
        $asistenciaExistente = Asistencia::where('id_user', $user_id)
            ->where('fecha', $fechaActual)
            ->first();

        if (!$asistenciaExistente) {
            // Si no existe asistencia para la fecha actual, registrar la hora de llegada
            Asistencia::create([
                'fecha' => $fechaActual,
                'hora_llegada' => $horaActual,
                'id_user' => $user_id,
            ]);

            return response()->json(['message' => 'Hora de llegada registrada con éxito.']);
        } else {
            // Si ya existe asistencia para la fecha actual, registrar la hora de salida
            $asistenciaExistente->hora_salida = $horaActual;
            $asistenciaExistente->save();

            return response()->json(['message' => 'Hora de salida registrada con éxito.']);
        }
    }


    public function registrarAsistenciaLlegada()
    {
        $user_id = auth()->user()->id;
        $now = Carbon::now();

        //Carbon::now()->timezone('America/La_Paz')->toTimeString();
        // Registrar la asistencia con la hora de llegada
        Asistencia::create([
            'fecha' => $now->toDateString(),
            'hora_llegada' => $now->timezone('America/La_Paz')->toTimeString(),
            'hora_salida' => null,
            'id_user' => $user_id,
        ]);

        return redirect()->route('asistencia.index')->with('success-llegada', 'Asistencia registrada correctamente');
    }


    public function registrarAsistenciaSalida()
    {
        $user_id = Auth::id();
        $now = Carbon::now();

        // Buscar el registro de asistencia correspondiente al usuario y fecha actual
        $asistencia = Asistencia::where('id_user', $user_id)
            ->where('fecha', $now->toDateString())
            ->first();

        if ($asistencia) {
            // Actualizar la hora de salida
            $asistencia->hora_salida = $now->timezone('America/La_Paz')->toTimeString();
            $asistencia->save();
        }

        return redirect()->route('asistencia.index')->with('success-salida', 'Salida registrada correctamente');
    }

    //hacer grafico de asistencia por usuario autenticado

    public function asistenciaPorPersonaMinutos(Request $request)
    {
        $mesSeleccionado = $request->input('mes');

        $asistenciasPorPersona = DB::table('asistencia')
            ->select(
                'persona.name as persona',
                DB::raw('SUM(EXTRACT(MINUTE FROM hora_llegada)) as total_minutos')
            )
            ->join('persona', 'asistencia.id_user', '=', 'persona.id')
            ->whereRaw('EXTRACT(MONTH FROM asistencia.fecha) = ?', [$mesSeleccionado])
            ->groupBy('persona.name')
            ->orderBy('persona.name')
            ->get();

        return view('grafico.graficoretrasos', compact('asistenciasPorPersona', 'mesSeleccionado'));
    }





    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Asistencia $asistencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asistencia $asistencia)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }
}
