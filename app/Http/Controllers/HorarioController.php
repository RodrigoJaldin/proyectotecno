<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $horarios = Horario::all();
        return view('horario.index', compact('horarios'));
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
        // Validar los datos del formulario de creación
        $request->validate([
            'turno' => 'required|min:1',
            'hora_entrada' => 'required',
            'hora_salida' => 'required',
        ]);

        // Crear el nuevo horario en la base de datos
        $horario = new Horario();
        $horario->turno = $request->input('turno');
        $horario->hora_entrada = $request->input('hora_entrada');
        $horario->hora_salida = $request->input('hora_salida');
        $horario->url = $request->fullUrl();
        $horario->save();

        // Redireccionar a la vista index con un mensaje de éxito
        return redirect()->route('horario.index')->with('success', 'El horario ha sido creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Horario $horario)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Horario $horario)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validar los datos del formulario de edición
        $request->validate([
            'turno' => 'required|min:1',
            'hora_entrada' => 'required',
            'hora_salida' => 'required',
        ]);

        // Obtener el horario existente por su ID
        $horario = Horario::findOrFail($id);

        // Actualizar los datos del horario
        $horario->turno = $request->input('turno');
        $horario->hora_entrada = $request->input('hora_entrada');
        $horario->hora_salida = $request->input('hora_salida');
        $horario->save();

        // Redireccionar a la vista index con un mensaje de éxito
        return redirect()->route('horario.index')->with('edit-success', 'El horario ha sido editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Obtener el usuario existente por su ID
        $horario = Horario::findOrFail($id);

        // Eliminar el usuario
        $horario->delete();

        // Redireccionar a la vista index con un mensaje de éxito
        return redirect()->route('horario.index')->with('eliminar', 'ok');
    }
}
