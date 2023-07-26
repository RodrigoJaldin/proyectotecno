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
        // Cargar la lista de usuarios disponibles
        $users = User::all();

        // Cargar la lista de horarios disponibles
        $horarios = Horario::all();

        // Cargar la lista de rotaciones (si tienes una relación en el modelo Rotacion, puedes usar "with")
        $rotaciones = Rotacion::all();

        return view('rotacion.index', compact('users', 'horarios', 'rotaciones'));
    }

    // Método para obtener los horarios de un usuario solicitante mediante una consulta AJAX
    public function getHorarios(Request $request, $usuarioId)
    {
        $horariosUsuario = HorarioUser::where('id_user', $usuarioId)->get();

        return response()->json($horariosUsuario);
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
        'usuario_solicitante' => 'required|exists:user,id',
        'usuario_reemplazante' => 'required|exists:user,id',
        'fecha' => 'required|date',
        'id_horario' => 'required|exists:horario,id',
    ]);

    // Guardar la nueva rotación en la base de datos
    Rotacion::create([
        'usuario_solicitante_id' => $request->input('usuario_solicitante'),
        'usuario_reemplazante_id' => $request->input('usuario_reemplazante'),
        'fecha' => $request->input('fecha'),
        'id_horario' => $request->input('id_horario'),
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
