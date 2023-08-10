<?php

namespace App\Http\Controllers;

use App\Models\Horario;
use App\Models\HorarioUser;
use App\Models\Sucursal;
use App\Models\User;
use Illuminate\Http\Request;

class HorarioUserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user(); // Obtener el usuario logueado
        $horarios = Horario::all(); // Obtener todos los horarios

        if ($user->rol->tipo_rol === 'Gerente') {
            // Si el usuario es Gerente, mostrar todos los horarios asignados
            $userHorarios = HorarioUser::with(['users', 'horario'])->get();
        } else {
            // Si el usuario no es Gerente, mostrar solo sus horarios asignados
            $userHorarios = HorarioUser::where('id_user', $user->id)->with(['users', 'horario'])->get();
        }

        return view('horario_user.index', compact('userHorarios', 'horarios'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    public function showUserHorarios($id)
    {
        $user = User::find($id);
        $horarios = Horario::all();
        if (!$user) {
            // Manejar el caso cuando el usuario no existe
            return redirect()->back()->with('error', 'Usuario no encontrado');
        }

        $userHorarios = HorarioUser::where('id_user', $id)->with(['users', 'horario'])->get();
        return view('horario_user.index', compact('userHorarios', 'user', 'horarios'));
    }





    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos recibidos del formulario
        $request->validate([
            'userId' => 'required|integer|exists:persona,id',
            'horario_id' => 'required|integer|exists:horario,id',
            'dia_laboral' => 'required|string|max:50',
        ]);

        // Obtener los datos del formulario
        $userId = $request->input('userId');
        $horarioId = $request->input('horario_id');
        $diaLaboral = $request->input('dia_laboral');

        // Verificar si el usuario ya tiene un horario asignado para el día laboral seleccionado
        $userHorario = HorarioUser::where('id_user', $userId)->where('dia_laboral', $diaLaboral)->first();

        if ($userHorario) {
            // Si el usuario ya tiene un horario asignado para el día laboral seleccionado, mostrar un mensaje de error
            return redirect()->back()->with('error-horario-existente', 'El usuario ya tiene un horario asignado para ese día laboral.');
        } else {
            // Si el usuario no tiene un horario asignado para el día laboral seleccionado, crear un nuevo registro
            HorarioUser::create([
                'id_user' => $userId,
                'id_horario' => $horarioId,
                'dia_laboral' => $diaLaboral,
            ]);

            // Redirigir de regreso al index de usuarios con un mensaje de éxito
            return redirect()->route('user.index')->with('success-horario-asignado', 'Horario asignado exitosamente');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(HorarioUser $horarioUser)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HorarioUser $horarioUser)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        // Validar los datos recibidos del formulario de edición
        $request->validate([
            'editHorarioId' => 'required|integer|exists:horario,id',
            'editDiaLaboral' => 'required|string|max:50',
        ]);

        try {
            // Obtener la asignación de horario a editar
            $userHorario = HorarioUser::findOrFail($id);

            // Actualizar los campos necesarios
            $userHorario->id_horario = $request->input('editHorarioId');
            $userHorario->dia_laboral = $request->input('editDiaLaboral');

            // Guardar los cambios
            $userHorario->save();

            return redirect()->route('horario_user.index')->with('edit-success', 'Horario asignado editado exitosamente');
        } catch (\Exception $e) {
            return redirect()->route('horario_user.index')->with('error', 'Ocurrió un error al editar el horario asignado');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HorarioUser $horarioUser)
    {
        $horarioUser->delete();

        return redirect()->route('horario_user.index')->with('eliminar', 'ok');
    }
}
