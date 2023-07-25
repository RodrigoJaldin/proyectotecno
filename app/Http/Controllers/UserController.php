<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\Rol;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        $users = User::all();
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return view('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }


    public function gerente()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Gerente');
        })->get();

        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return redirect()->route('user')->with(compact('users', 'roles', 'sucursales', 'horarios'));
    }

    public function jefesCocina()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Jefe de Cocina');
        })->get();

        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return redirect()->route('user')->with(compact('users', 'roles', 'sucursales', 'horarios'));
    }

    public function jefesCaja()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Jefe de Caja');
        })->get();
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return redirect()->route('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }

    public function jefesAlmacen()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Jefe de Almacen');
        })->get();
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return redirect()->route('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }

    public function encargadosPlancha()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Encargado de Plancha');
        })->get();
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return redirect()->route('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }
    public function auxiliaresCocina()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Auxiliar de Cocina');
        })->get();
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return redirect()->route('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }
    public function cajeros()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Cajero');
        })->get();
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return redirect()->route('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }
    public function limpieza()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Limpieza');
        })->get();
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return redirect()->route('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function showHorario($userId)
    {
        $user = User::findOrFail($userId);

        // Obtener el horario del usuario
        $horario = $user->user_horario;

        return view('user.show_horario_modal', compact('horario'));
    }
    public function store(Request $request)
    {
         // Validar los datos del formulario de creación
         $request->validate([
            'name' => 'required|min:1',
            'apellido' => 'required|min:1',
            'email' => 'required|email|unique:user,email',
            'ci' => 'required|min:1',
            'telefono' => 'required|min:1',
            'foto_user' => ['image', 'nullable', 'max:2048'],
            'codigo_empleado' => 'required|unique:user,codigo_empleado',
            'id_rol' => 'required|exists:rol,id',
            'id_sucursal' => 'required|exists:sucursal,id',
        ]);

        // Crear el nuevo usuario en la base de datos
        $user = new User();
        $user->name = $request->input('name');
        $user->apellido = $request->input('apellido');
        $user->email = $request->input('email');
        $user->ci = $request->input('ci');
        $user->telefono = $request->input('telefono');
        $user->password = $request->input('password');
        $user->codigo_empleado = $request->input('codigo_empleado');
        $user->id_rol = $request->input('id_rol');
        $user->id_sucursal = $request->input('id_sucursal');

        if ($request->hasFile('foto_user')) {
            $foto = $request->file('foto_user')->store('public/users_imagenes');
            $url = Storage::url($foto);
            $user->foto_user = $url;
        }

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
            'name' => 'required|min:1',
            'apellido' => 'required|min:1',
            'email' => 'required|email|unique:users,email,' . $id,
            'ci' => 'required|min:1',
            'telefono' => 'required|min:1',
            'foto_user' => ['image', 'nullable', 'max:2048'],
            'codigo_empleado' => 'required|unique:users,codigo_empleado,' . $id,
            'id_rol' => 'required|exists:rol,id',
        ]);

        // Obtener el usuario existente por su ID
        $user = User::findOrFail($id);

        // Actualizar los datos del usuario
        $user->name = $request->input('name');
        $user->apellido = $request->input('apellido');
        $user->email = $request->input('email');
        $user->ci = $request->input('ci');
        $user->telefono = $request->input('telefono');
        $user->codigo_empleado = $request->input('codigo_empleado');
        $user->id_rol = $request->input('id_rol');
        $user->id_sucursal = $request->input('id_sucursal');
        if ($request->hasFile('foto_user')) {
            // Eliminar la foto anterior si existe
            if ($user->foto_user) {
                Storage::delete($user->foto_user);
            }

            $foto = $request->file('foto_user')->store('public/users_imagenes');
            $url = Storage::url($foto);
            $user->foto_user = $url;
        }

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
