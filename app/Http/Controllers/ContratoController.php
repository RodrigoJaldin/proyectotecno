<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\User;
use Illuminate\Http\Request;

class ContratoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $contratos = Contrato::all();
        $users = User::all();
        return view('contrato.index', compact('contratos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::all();
        return view('contrato.create', compact('usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'horas_laborales' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'sueldo' => 'required|numeric',
            'id_user' => 'required|exists:user,id',
        ]);

        Contrato::create($request->all());

        return redirect()->route('contrato.index')
            ->with('success', 'Contrato creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Contrato $contrato)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrato $contrato)
    {
        $usuarios = User::all();
        return view('contrato.edit', compact('contrato', 'usuarios'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contrato $contrato)
    {
        $request->validate([
            'horas_laborales' => 'required|numeric',
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'sueldo' => 'required|numeric',
            'id_user' => 'required|exists:user,id',
        ]);

        $contrato->update($request->all());

        return redirect()->route('contrato.index')
            ->with('success', 'Contrato actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contrato $contrato)
    {
        $contrato->delete();

        return redirect()->route('contrato.index')
            ->with('success', 'Contrato eliminado exitosamente.');
    }
}
