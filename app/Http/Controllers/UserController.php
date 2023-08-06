<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Contrato;
use App\Models\Horario;
use App\Models\Rol;
use App\Models\Sucursal;
use App\Models\TurnoExtra;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
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

        foreach ($users as $usuario) {
            $nomina = $this->calcularNomina($usuario->id);
            $usuario->nomina = $nomina;
        }

        return view('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }
    /*   public function calcularNomina($user_id)
    {
        // Obtener el usuario
        $user = User::findOrFail($user_id);

        // Obtener el contrato del usuario
        $contrato = Contrato::where('id_user', $user_id)->first();

        // Verificar si el usuario tiene un contrato registrado
        if (!$contrato) {
            // Si no tiene un contrato registrado, retornar un mensaje de error
            return [
                'error' => 'El usuario no tiene un contrato registrado.',
            ];
        }

        // Calcular el monto a pagar por hora al usuario
        $montoPorHora = $contrato->sueldo / $contrato->horas_laborales;

        // Obtener las asistencias del usuario en el mes actual
        $asistencias = Asistencia::where('id_user', $user_id)
            ->whereMonth('fecha', now()->month)
            ->get();

        // Calcular la suma total de minutos trabajados
        $minutosTrabajados = 0;

        // Verificar si el usuario tiene asistencias registradas
        if (!$asistencias->isEmpty()) {
            foreach ($asistencias as $asistencia) {
                $horaEntrada = Carbon::parse($asistencia->hora_entrada);
                $horaSalida = Carbon::parse($asistencia->hora_salida);

                // Calcular los minutos trabajados en esta asistencia
                $minutosTrabajados += $horaEntrada->diffInMinutes($horaSalida);
            }
        }

        // Calcular el total de minutos de retraso
        $minutosRetraso = 0;
        $horarios = $user->horarios;
        if (!$horarios->isEmpty()) {
            foreach ($horarios as $horario) {
                $horaEntradaHorario = Carbon::parse($horario->hora_entrada);
                foreach ($asistencias as $asistencia) {
                    $horaEntrada = Carbon::parse($asistencia->hora_entrada);
                    if ($horaEntrada->greaterThan($horaEntradaHorario)) {
                        $retraso = $horaEntrada->diffInMinutes($horaEntradaHorario);
                        $minutosRetraso += $retraso;
                    }
                }
            }
        }

        // Calcular el descuento por faltas en función de las horas trabajadas en relación con las horas laborales establecidas en el contrato
        $horasTrabajadas = $minutosTrabajados / 60;
        $descuentoFaltas = ($horasTrabajadas < $contrato->horas_laborales) ? ($contrato->horas_laborales - $horasTrabajadas) * $montoPorHora : 0;

        // Calcular el monto a pagar por horas extras
        $horasExtras = max($horasTrabajadas - $contrato->horas_laborales, 0);
        $montoHorasExtras = $horasExtras * $montoPorHora;

        // Calcular el sueldo sin descuentos por retraso y faltas
        $sueldoSinDescuentos = ($minutosTrabajados / 60) * $montoPorHora;

        // Calcular el sueldo con descuentos por retraso y faltas
        $sueldoConDescuentos = $sueldoSinDescuentos - $descuentoFaltas;

        // Verificar si el sueldo con descuentos es menor que cero y establecerlo en cero si es así
        $sueldoConDescuentos = max($sueldoConDescuentos, 0);

        // Calcular el total a pagar al usuario
        $totalAPagar = $sueldoConDescuentos + $montoHorasExtras;

        // Retornar los resultados en un arreglo
        return [
            'user' => $user,
            'sueldoActual' => $contrato->sueldo,
            'horas_laborales' => $contrato->horas_laborales,
            'sueldoPorHora' => $montoPorHora,
            'minutosTrabajados' => $minutosTrabajados,
            'minutosRetraso' => $minutosRetraso,
            'descuentoFaltas' => $descuentoFaltas,
            'montoHorasExtras' => $montoHorasExtras,
            'totalAPagar' => $totalAPagar,
        ];
    }
 */
    //calcular nomina

    public function calcularNomina($user_id)
    {
        // Obtener el usuario
        $user = User::findOrFail($user_id);

        // Obtener el contrato del usuario
        $contrato = Contrato::where('id_user', $user_id)->first();

        // Verificar si el usuario tiene un contrato registrado
        if (!$contrato) {
            // Si no tiene un contrato registrado, retornar un mensaje de error
            return [
                'error' => 'El usuario no tiene un contrato registrado.',
            ];
        }

        // Calcular el monto a pagar por hora al usuario
        $montoPorHora = $contrato->sueldo / $contrato->horas_laborales;

        // Obtener las asistencias del usuario en el mes actual
        $asistencias = Asistencia::where('id_user', $user_id)
            ->whereMonth('fecha', now()->month)
            ->get();

        // Calcular la suma total de minutos trabajados
        $minutosTrabajados = 0;
        foreach ($asistencias as $asistencia) {
            $horaEntrada = strtotime($asistencia->hora_llegada);
            $horaSalida = strtotime($asistencia->hora_salida);
            $minutosTrabajados += ($horaSalida - $horaEntrada) / 60;
        }

        // Calcular el monto a pagar al usuario
        $montoAPagar = $minutosTrabajados * $montoPorHora;

        // Obtener los turnos extras del usuario en el mes actual, no tiene fecha
        $turnosExtras = TurnoExtra::where('id_user', $user_id)
            ->whereMonth('created_at', now()->month)
            ->get();

        // Calcular la suma total de horas de los turnos extras
        $horasTurnosExtras = 0;
        foreach ($turnosExtras as $turnoExtra) {
            $horasTurnosExtras += $turnoExtra->cantidad_horas;
        }

        // Calcular el monto a pagar por los turnos extras
        $montoAPagar += $horasTurnosExtras * $montoPorHora;

        // Retornar los datos de la nómina
        return [
            'user' => $user,
            'contrato' => $contrato,
            'monto_por_hora' => $montoPorHora,
            'asistencias' => $asistencias,
            'minutos_trabajados' => $minutosTrabajados,
            'monto_a_pagar' => $montoAPagar,
            'turnos_extras' => $turnosExtras,
            'horas_turnos_extras' => $horasTurnosExtras,
        ];
    }

    public function showNomina($user_id)
    {
        // Call the calcularNomina function to get the calculated data
        $nominaData = $this->calcularNomina($user_id);

        // Check if there's an error in the data
        if (isset($nominaData['error'])) {
            // If there's an error, return the view with the error message
            return view('user.nomina', ['error' => $nominaData['error']]);
        }

        // If there's no error, continue and return the view with the calculated data
        return view('user.nomina', [
            'user' => $nominaData['user'],
            'contrato' => $nominaData['contrato'],
            'monto_por_hora' => $nominaData['monto_por_hora'],
            'asistencias' => $nominaData['asistencias'],
            'minutos_trabajados' => $nominaData['minutos_trabajados'],
            'monto_a_pagar' => $nominaData['monto_a_pagar'],
            'turnos_extras' => $nominaData['turnos_extras'],
            'horas_turnos_extras' => $nominaData['horas_turnos_extras'],
        ]);
    }

// Controlador
public function graficoNominas()
{
    // Obtener todos los usuarios
    $users = User::all();

    // Inicializar arreglos para almacenar los datos de las nóminas por usuario
    $usersArray = [];
    $montoAPagarArray = [];

    // Procesar los datos de las nóminas de cada usuario
    foreach ($users as $user) {
        // Obtener los datos de la nómina para el usuario actual
        $nominaData = $this->calcularNomina($user->id);

        // Verificar si la nómina tiene el monto a pagar
        if (isset($nominaData['monto_a_pagar'])) {
            // Agregar el nombre del usuario y el monto a pagar a los arreglos correspondientes
            $usersArray[] = $user->name . ' ' . $user->apellido;
            $montoAPagarArray[] = $nominaData['monto_a_pagar'];
        }
    }

    // Retornar los datos procesados para el gráfico
    return view('grafico.graficonomina', [
        'users' => $usersArray,
        'montoAPagar' => $montoAPagarArray,
    ]);
}





    public function calcularNomina2($id_user)
    {
        // Obtener el usuario con el id proporcionado junto con sus contratos, horarios, asistencias y turnos extras
        $usuario = User::with(['contrato', 'user_horarios', 'asistencia', 'turno_extra'])
            ->leftJoin('user_horario', 'user.id', '=', 'user_horario.id_user')
            ->leftJoin('horarios', 'user_horario.id_horario', '=', 'horarios.id')
            ->selectRaw('user.*, horarios.hora_entrada, horarios.hora_salida')
            ->find($id_user);

        // Verificar si el usuario existe
        if (!$usuario) {
            return response()->json(['error' => 'Usuario no encontrado'], 404);
        }

        // Obtener el sueldo por hora del usuario
        $sueldoPorHora = $usuario->contrato->sueldo / $usuario->contrato->horas_laborales;

        // Calcular las horas trabajadas (suma de las horas en las asistencias)
        $horasTrabajadas = $usuario->asistencia->sum(function ($asistencia) {
            return $asistencia->hora_salida - $asistencia->hora_llegada;
        });

        // Calcular los minutos de retraso
        $minutosRetraso = $usuario->asistencia->sum(function ($asistencia) use ($usuario) {
            $horaEntradaHorario = strtotime($usuario->user_horarios->where('dia_laboral', $asistencia->fecha->format('N'))->first()->horario->hora_entrada);
            $horaLlegada = strtotime($asistencia->hora_llegada);
            return max(0, ($horaLlegada - $horaEntradaHorario) / 60);
        });

        // Reducir el salario por minutos de retraso
        $salarioFinal = max(0, $usuario->contrato->sueldo - ($minutosRetraso * ($sueldoPorHora / 60)));

        // Calcular el salario por turnos extras
        $salarioFinal += $usuario->turno_extra->sum('cantidad_horas') * $sueldoPorHora;

        // Aquí puedes hacer lo que desees con el resultado de la nómina
        // Puedes devolverlo como respuesta HTTP, almacenarlo en una tabla en la base de datos, etc.

        // Ejemplo: Devolver el resultado como respuesta HTTP en formato JSON
        return response()->json([
            'usuario' => $usuario->name . ' ' . $usuario->apellido,
            'salario' => $salarioFinal,
        ]);
    }










    public function nomina()
    {
        // Obtener la lista de usuarios
        $usuarios = User::all();

        // Calcular la nómina para cada usuario y agregar los resultados al arreglo $usuarios
        foreach ($usuarios as $usuario) {
            $usuario->nomina = $this->calcularNomina($usuario->id);
        }

        // Cargar la vista nomina.blade.php y pasar la lista de usuarios
        return view('user.nomina', compact('usuarios'));
    }





    public function gerente()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Gerente');
        })->get();

        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return view('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }

    public function jefesCocina()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Jefe de Cocina');
        })->get();

        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return view('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }

    public function jefesCaja()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Jefe de Caja');
        })->get();
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return view('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }

    public function jefesAlmacen()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Jefe de Almacen');
        })->get();
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return view('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }

    public function encargadosPlancha()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Encargado de Plancha');
        })->get();
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return view('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }
    public function auxiliaresCocina()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Auxiliar de Cocina');
        })->get();
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return view('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }
    public function cajeros()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Cajero');
        })->get();
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return view('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
    }
    public function limpieza()
    {
        $users = User::whereHas('rol', function ($query) {
            $query->where('tipo_rol', 'Limpieza');
        })->get();
        $roles = Rol::all();
        $sucursales = Sucursal::all();
        $horarios = Horario::all();

        return view('user.index', compact('users', 'roles', 'sucursales', 'horarios'));
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
            'email' => 'required|email|unique:persona,email',
            'ci' => 'required|min:1',
            'telefono' => 'required|min:1',
            'foto_user' => ['image', 'nullable', 'max:2048'],
            'codigo_empleado' => 'required|unique:persona,codigo_empleado',
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
        $user->password = Hash::make($request->input('password')); // Generar el hash de la contraseña
        $user->codigo_empleado = $request->input('codigo_empleado');
        $user->id_rol = $request->input('id_rol');
        $user->id_sucursal = $request->input('id_sucursal');
        $user->url = $request->fullUrl();

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
            'email' => 'required|email|unique:persona,email,' . $id,
            'ci' => 'required|min:1',
            'telefono' => 'required|min:1',
            'foto_user' => ['image', 'nullable', 'max:2048'],
            'codigo_empleado' => 'required|unique:persona,codigo_empleado,' . $id,
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

        // Actualizar la contraseña si se proporciona una nueva
        $newPassword = $request->input('password');
        if ($newPassword) {
            $user->password = Hash::make($newPassword);
        }
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


    public function mostrarVista()
    {
        $user_id = Auth::id();
        $menuItems = DB::table('menus')->where('user_id', $user_id)->get();
        return view('layouts.app', ['menuItems' => $menuItems]);
    }
}
