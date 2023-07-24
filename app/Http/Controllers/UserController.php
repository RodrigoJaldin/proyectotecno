<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        $roles = Rol::all();
        return view('user.index', compact('users', 'roles'));
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
            'nombre' => 'required|min:1',
            'apellido' => 'required|min:1',
            'email' => 'required|email|unique:users,email',
            'ci' => 'required|min:1',
            'telefono' => 'required|min:1',
            'codigo_empleado' => 'required|unique:users,codigo_empleado',
            'id_rol' => 'required|exists:rol,id',
        ]);

        // Crear el nuevo usuario en la base de datos
        $user = new User();
        $user->nombre = $request->input('nombre');
        $user->apellido = $request->input('apellido');
        $user->email = $request->input('email');
        $user->ci = $request->input('ci');
        $user->telefono = $request->input('telefono');
        $user->codigo_empleado = $request->input('codigo_empleado');
        $user->id_rol = $request->input('id_rol');
        $user->save();

        // Redireccionar a la vista index con un mensaje de éxito
        return redirect()->route('user.index')->with('success', 'El usuario ha sido creado exitosamente');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
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
            'nombre' => 'required|min:1',
            'apellido' => 'required|min:1',
            'email' => 'required|email|unique:users,email,' . $id,
            'ci' => 'required|min:1',
            'telefono' => 'required|min:1',
            'codigo_empleado' => 'required|unique:users,codigo_empleado,' . $id,
            'id_rol' => 'required|exists:rol,id',
        ]);

        // Obtener el usuario existente por su ID
        $user = User::findOrFail($id);

        // Actualizar los datos del usuario
        $user->nombre = $request->input('nombre');
        $user->apellido = $request->input('apellido');
        $user->email = $request->input('email');
        $user->ci = $request->input('ci');
        $user->telefono = $request->input('telefono');
        $user->codigo_empleado = $request->input('codigo_empleado');
        $user->id_rol = $request->input('id_rol');
        $user->save();

        // Redireccionar a la vista index con un mensaje de éxito
        return redirect()->route('user.index')->with('edit-success', 'El usuario ha sido editado exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        // Obtener el usuario existente por su ID
        $user = User::findOrFail($id);

        // Eliminar el usuario
        $user->delete();

        // Redireccionar a la vista index con un mensaje de éxito
        return redirect()->route('user.index')->with('eliminar', 'ok');
    }
}
