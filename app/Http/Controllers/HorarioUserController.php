<?php

namespace App\Http\Controllers;

use App\Models\HorarioUser;
use Illuminate\Http\Request;

class HorarioUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $request->validate([
            'userId' => 'required|integer|exists:users,id',
            'horario_id' => 'required|integer|exists:horario,id',
            'dia_laboral' => 'required|in:Lunes,Martes,Miércoles,Jueves,Viernes,Sábado,Domingo',
        ]);

        $userId = $request->input('userId');
        $horarioId = $request->input('horario_id');
        $diaLaboral = $request->input('dia_laboral');
        dd($userId);
        // Verificar si el usuario ya tiene un horario asignado para el día laboral seleccionado
        $userHorario = HorarioUser::where('id_user', $userId)->where('dia_laboral', $diaLaboral)->first();

        if ($userHorario) {
            // Si el usuario ya tiene un horario asignado para el día laboral seleccionado, actualizar el horario
            $userHorario->update(['id_horario' => $horarioId]);
        } else {
            // Si el usuario no tiene un horario asignado para el día laboral seleccionado, crear un nuevo registro
            HorarioUser::create([
                'id_user' => $userId,
                'id_horario' => $horarioId,
                'dia_laboral' => $diaLaboral,
            ]);
        }

        return redirect()->back()->with('success-asignar-horario', 'Horario asignado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(HorarioUser $horarioUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HorarioUser $horarioUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HorarioUser $horarioUser)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HorarioUser $horarioUser)
    {
        //
    }
}
