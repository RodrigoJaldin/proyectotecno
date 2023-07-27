<?php

namespace App\Http\Controllers;

use App\Models\Licencia;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class LicenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $licencias = Licencia::all();
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
            'id_user' => 'required|exists:user,id',
        ]);

        $licencia = new Licencia();
        $licencia->fecha_inicio = $request->fecha_inicio;
        $licencia->fecha_fin = $request->fecha_fin;
        $licencia->tipo_licencia = $request->tipo_licencia;
        $licencia->id_user = $request->id_user;

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


    public function update(Request $request, Licencia $licencia)
    {
        $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date|after_or_equal:fecha_inicio',
            'tipo_licencia' => 'required',
            'id_user' => 'required|exists:user,id',
        ]);

        $licencia->fecha_inicio = $request->fecha_inicio;
        $licencia->fecha_fin = $request->fecha_fin;
        $licencia->tipo_licencia = $request->tipo_licencia;
        $licencia->id_user = $request->id_user;

        $licencia->save();

        return redirect()->route('licencia.index')->with('edit-success', 'La licencia ha sido editada exitosamente.');
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
    $licenciasPorUsuario = Licencia::join('user', 'licencia.id_user', '=', 'user.id')
        ->groupBy('user.id')
        ->select('user.name', 'user.apellido', DB::raw('count(*) as total'))
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
