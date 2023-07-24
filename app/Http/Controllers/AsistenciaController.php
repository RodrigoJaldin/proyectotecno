<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    public function registrarAsistencia(Request $request)
    {
        $fechaActual = now()->toDateString(); // Obtener la fecha actual en formato yyyy-mm-dd
        $horaActual = now()->toTimeString(); // Obtener la hora actual en formato hh:mm:ss
        $user_id = Auth::id();

        // Comprobar si el usuario ya tiene una asistencia registrada para la fecha actual
        $asistenciaExistente = Asistencia::where('id_user', $request->id_user)
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

    /*

public function registrarAsistenciaLlegada()
{
    $user_id = Auth::id();
    $now = Carbon::now();

    // Registrar la asistencia con la hora de llegada
    Asistencia::create([
        'fecha' => $now->toDateString(),
        'hora_llegada' => $now->toTimeString(),
        'hora_salida' => null,
        'id_user' => $user_id,
    ]);

    // Resto del código de redireccionamiento o respuesta
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
        $asistencia->hora_salida = $now->toTimeString();
        $asistencia->save();
    }

    // Resto del código de redireccionamiento o respuesta
}

    */

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
