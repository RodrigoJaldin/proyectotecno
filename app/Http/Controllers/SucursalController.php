<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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




    public function trabajadoresPorSucursal($sucursal_id)
    {
        //dd($sucursal_id);
        $sucursal = Sucursal::findOrFail($sucursal_id);
        $trabajadores = $sucursal->users;

        return view('sucursal.trabajadores', compact('trabajadores', 'sucursal'));
    }

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

        // Crear la nueva sucursal en la base de datos
        $sucursal = new Sucursal();
        $sucursal->nombre = $request->input('nombre');
        $sucursal->direccion = $request->input('direccion');
        $sucursal->url = $request->fullUrl();
        $sucursal->save();

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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nombre' => 'required',
            'direccion' => 'required',
        ]);

        // Obtener el usuario existente por su ID
        $sucursal = Sucursal::findOrFail($id);

         // Actualizar los datos del usuario
         $sucursal->nombre = $request->input('nombre');
         $sucursal->direccion = $request->input('direccion');

         $sucursal->save();
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
