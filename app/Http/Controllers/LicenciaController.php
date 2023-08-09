<?php

namespace App\Http\Controllers;

use App\Models\Licencia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class LicenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user(); // Obtener el usuario autenticado

        if ($user->rol->tipo_rol === 'Gerente') {
            // Si el usuario es un Gerente, mostrar todas las licencias
            $licencias = Licencia::all();
        } else {
            // Si el usuario tiene otro rol, mostrar solo sus licencias
            $licencias = Licencia::where('id_user', $user->id)->get();
        }

        $users = User::all();
        return view('licencia.index', compact('licencias', 'users'));
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
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'tipo_licencia' => 'required',
        ]);

        $user = Auth::user(); // Obtener el usuario autenticado
        $id_user = $user->id;

        $licencia = new Licencia();
        $licencia->fecha_inicio = $request->fecha_inicio;
        $licencia->fecha_fin = $request->fecha_fin;
        $licencia->tipo_licencia = $request->tipo_licencia;
        $licencia->estado = 'pendiente'; // Estado por defecto
        $licencia->url = $request->fullUrl();
        $licencia->id_user = $id_user; // Asignar el id del usuario autenticado

        $licencia->save();

        return redirect()->route('licencia.index')->with('success', 'La licencia ha sido creada exitosamente.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Licencia $licencia)
    {
        //
    }


    public function edit(Licencia $licencia)
    {
        //
    }


    public function update(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|in:aceptar,rechazar',
        ]);

        $licencia = Licencia::findOrFail($id);

        $user = Auth::user(); // Obtener el usuario autenticado

        // Verificar si el usuario es un Gerente
        if ($user->rol->tipo_rol === 'Gerente') {
            $licencia->estado = $request->estado;
            $licencia->save();

            return redirect()->route('licencia.index')->with('edit-success', 'El estado de la licencia ha sido actualizado exitosamente.');
        } else {
            return redirect()->route('licencia.index')->with('error', 'No tienes permiso para actualizar el estado de esta licencia.');
        }
    }
        /**
     * Remove the specified resource from storage.
     */
    public function destroy(Licencia $licencia)
    {
        $licencia->delete();

        return redirect()->route('licencia.index')->with('eliminar', 'ok');
    }

    //funcion para mostrar la cantidad de licencias por usuarios
    public function licenciasPorUsuario()
    {
        $licenciasPorUsuario = Licencia::join('persona', 'licencia.id_user', '=', 'persona.id')
            ->groupBy('persona.id')
            ->select('persona.name', 'persona.apellido', DB::raw('count(*) as total'))
            ->get();

        // Preparar los datos para el gráfico
        $users = $licenciasPorUsuario->map(function ($item) {
            return $item->nombre . ' ' . $item->apellido;
        });
        $cantidadLicencias = $licenciasPorUsuario->pluck('total');

        // Pasar los datos a la vista para el gráfico
        return view('grafico.graficolicencia', compact('users', 'cantidadLicencias'));
    }
}
