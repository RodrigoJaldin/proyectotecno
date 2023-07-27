<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Rol::all();
        return view('rol.index', compact('roles'));
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
            'tipo_rol' => 'required|string|max:255',
        ]);

        // Crear un nuevo rol con los datos recibidos del formulario
        Rol::create([
            'tipo_rol' => $request->input('tipo_rol'),
            'url' => $request->fullUrl(),
        ]);

        // Redireccionar a la vista index con un mensaje de éxito
        return redirect()->route('rol.index')->with('success', 'El rol ha sido creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Rol $rol)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rol $rol)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipo_rol' => 'required|string|max:255',
        ]);

        // Obtener el rol que se va a actualizar
        $rol = Rol::findOrFail($id);

        // Actualizar los datos del rol con los datos recibidos del formulario
        $rol->update([
            'tipo_rol' => $request->input('tipo_rol'),
        ]);

        // Redireccionar a la vista index con un mensaje de éxito
        return redirect()->route('rol.index')->with('edit-success', 'El rol ha sido editado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rol = Rol::find($id);

        // Eliminar el rol
        $rol->delete();

        return redirect('rol')->with('eliminar', 'ok');
    }
}
