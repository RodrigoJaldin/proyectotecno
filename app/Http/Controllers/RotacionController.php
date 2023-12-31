<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\HorarioUser;
use App\Models\Rotacion;
use App\Models\User;
use Illuminate\Http\Request;

class RotacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index()
    {
        // Cargar la lista de rotaciones con sus relaciones
        $rotaciones = Rotacion::with(['userHorarios_solicitante', 'userHorarios_reemplazante'])->get();

        // Cargar la lista de usuarios disponibles con horarios asignados y sus detalles
        $usersWithHorarios = User::whereHas('user_horarios')->with(['user_horarios.horario'])->get();

         // Cargar la lista de usuarios disponibles con horarios asignados
        // $users  = User::whereHas('user_horarios')->get();

        // Filtrar los usuarios reemplazantes excluyendo al usuario solicitante
        $usersReemplazantes = User::whereHas('user_horarios')->where('id', '!=', old('usuario_solicitante_id'))->get();

        return view('rotacion.index', compact('rotaciones', 'usersWithHorarios', 'usersReemplazantes'));
    }




    // Método para obtener los horarios de un usuario solicitante mediante una consulta AJAX

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
            'fecha' => 'required|date',
            'usuario_solicitante' => 'required|exists:user_horario,id',
            'usuario_reemplazante' => 'required|exists:user_horario,id|different:usuario_solicitante',
        ]);

        // Obtener los IDs de los user_horario seleccionados
        $usuarioSolicitanteId = $request->input('usuario_solicitante');
        $usuarioReemplazanteId = $request->input('usuario_reemplazante');

        // Guardar la nueva rotación en la base de datos
        Rotacion::create([
            'fecha' => $request->input('fecha'),
            'usuario_solicitante_id' => $usuarioSolicitanteId,
            'usuario_reemplazante_id' => $usuarioReemplazanteId,
            'url' => $request->fullUrl(),
        ]);

        return redirect()->route('rotacion.index')->with('success', 'La rotación ha sido registrada exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rotacion $rotacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rotacion $rotacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rotacion $rotacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rotacion $rotacion)
    {
        //
    }
}
