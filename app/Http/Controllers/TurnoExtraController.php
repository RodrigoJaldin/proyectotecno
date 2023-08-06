<?php

namespace App\Http\Controllers;

use App\Models\TurnoExtra;
use App\Models\User;
use Illuminate\Http\Request;

class TurnoExtraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $turnosExtra = TurnoExtra::all();
        $users = User::all();
        return view('turno_extras.index', compact('turnosExtra', 'users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();
        return view('turno_extras.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'cantidad_horas' => 'required|integer',
            'id_user' => 'required|exists:user,id',
        ]);

        TurnoExtra::create($request->all());

        return redirect()->route('turnosExtra.index')->with('success', 'Turno Extra creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(TurnoExtra $turnoExtra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TurnoExtra $turnoExtra)
    {
        $users = User::all();
        return view('turno_extras.edit', compact('turnoExtra', 'users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TurnoExtra $turnoExtra)
    {
        $request->validate([
            'cantidad_horas' => 'required|integer',
            'id_user' => 'required|exists:persona,id',
        ]);

        $turnoExtra->update($request->all());

        return redirect()->route('turnosExtra.index')->with('success', 'Turno Extra actualizado exitosamente');
    }

    public function destroy(TurnoExtra $turnoExtra)
    {
        $turnoExtra->delete();

        return redirect()->route('turnosExtra.index')->with('success', 'Turno Extra eliminado exitosamente');
    }
}
