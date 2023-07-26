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
        $userHorarios = HorarioUser::with(['users', 'horario'])->get();
        return view('horario_user.index', compact('userHorarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function showUserHorarios($user_id)
    {
        $userHorarios = HorarioUser::where('id_user', $user_id)->with(['users', 'horario'])->get();
        return view('horario_user.index', compact('userHorarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos del formulario
        $request->validate([
            'userId' => 'required|integer|exists:user,id',
            'horario_id' => 'required|integer|exists:horario,id',
            'dia_laboral' => 'required|string|max:50',
        ]);

        // Obtener los datos del formulario
        $userId = $request->input('userId');
        $horarioId = $request->input('horario_id');
        $diaLaboral = $request->input('dia_laboral');

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

        // Redirigir de regreso al index de usuarios con un mensaje de éxito
        return redirect()->route('user.index')->with('success-horario-asignado', 'Horario asignado exitosamente');
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
