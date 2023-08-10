<?php

namespace App\Http\Controllers;

use App\Models\Licencia;
use App\Models\User;
use Carbon\Carbon;
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
        $user = Auth::user();

        if ($user->rol->tipo_rol === 'Gerente') {
            $licencias = Licencia::all();
        } else {
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
        $user = Auth::user();
        $request->validate([
            'fecha_inicio' => 'required|date|date_format:Y-m-d',
            'fecha_fin' => 'required|date|date_format:Y-m-d|after_or_equal:fecha_inicio',
            'tipo_licencia' => 'required',
        ]);

        $fechaInicio = Carbon::parse($request->fecha_inicio);
        $fechaFin = Carbon::parse($request->fecha_fin);

        if ($fechaFin->isBefore($fechaInicio)) {
            // Establecer un mensaje en la sesión y redirigir con error
            return redirect()->route('licencia.index')->with('error-fecha-invalida', 'La fecha de fin no puede ser antes que la fecha de inicio.');
        }

        $id_user = $user->id;

        // Si el usuario tiene el rol de "gerente" y proporcionó un ID de usuario
        if ($user->rol->tipo_rol = 'Gerente' && $request->has('id_user')) {
            $selectedUser = User::find($request->id_user);
            if ($selectedUser) {
                $id_user = $selectedUser->id;
            }
        }

        $licencia = new Licencia();
        $licencia->fecha_inicio = $request->fecha_inicio;
        $licencia->fecha_fin = $request->fecha_fin;
        $licencia->tipo_licencia = $request->tipo_licencia;
        $licencia->estado = 'pendiente';
        $licencia->url = $request->fullUrl();
        $licencia->id_user = $id_user;

        $licencia->save();

        // Mostrar una alerta de éxito

        return redirect()->route('licencia.index')->with('success');
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
