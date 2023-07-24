<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;

class SucursalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sucursales = Sucursal::all();
        return view('sucursal.index', compact('sucursales'));
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
            'nombre' => 'required',
            'direccion' => 'required',
        ]);

        Sucursal::create([
            'nombre' => $request->input('nombre'),
            'direccion' => $request->input('direccion'),
        ]);

        return redirect()->route('sucursal.index')->with('success', 'La sucursal ha sido creada exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(Sucursal $sucursal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Sucursal $sucursal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Sucursal $sucursal)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
        ]);

        $sucursal->update([
            'nombre' => $request->input('nombre'),
            'direccion' => $request->input('direccion'),
        ]);

        return redirect()->route('sucursal.index')->with('edit-success', 'La sucursal ha sido editada exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Sucursal $sucursal)
    {
        $sucursal->delete();

        return redirect()->route('sucursal.index')->with('eliminar', 'ok');
    }
}
