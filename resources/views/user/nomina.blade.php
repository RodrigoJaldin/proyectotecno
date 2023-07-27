@extends('layouts.app')

@section('content')
    <div align="center">
        <h1>Nómina del usuario</h1>
    </div>

    @if (isset($error))
        <p>{{ $error }}</p>
    @else
        <h2>Detalles del Usuario</h2>
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
            </tr>
            <tr>
                <td>{{ $user->id }}</td>
                <td>{{ $user->name }}</td>
                <td>{{ $user->apellido }}</td>
                <td>{{ $user->email }}</td>
            </tr>
        </table>

        <h2>Detalles del Contrato</h2>
        <table class="table">
            <tr>
                <th>ID del Contrato</th>
                <th>Sueldo</th>
                <th>Horas Laborales</th>
                <th>Sueldo por Hora</th>
            </tr>
            <tr>
                <td>{{ $contrato->id }}</td>
                <td>{{ $contrato->sueldo }}</td>
                <td>{{ $contrato->horas_laborales }}</td>
                <td>${{ $monto_por_hora }}</td>
            </tr>
        </table>

        <h2>Asistencias del Usuario en el Mes Actual</h2>
        <table class="table">
            <tr>
                <th>Fecha</th>
                <th>Hora de Llegada</th>
                <th>Hora de Salida</th>
            </tr>
            @foreach ($asistencias as $asistencia)
                <tr>
                    <td>{{ $asistencia->fecha }}</td>
                    <td>{{ $asistencia->hora_llegada }}</td>
                    <td>{{ $asistencia->hora_salida }}</td>
                </tr>
            @endforeach
        </table>

        <h2>Detalles de la Nómina</h2>
        <table class="table">
            <tr>
                <th>Minutos Trabajados</th>
                <th>Monto a Pagar</th>
            </tr>
            <tr>
                <td>{{ $minutos_trabajados }}</td>
                <td>${{ $monto_a_pagar }}</td>
            </tr>
        </table>

        @if (!$turnos_extras->isEmpty())
            <h2>Turnos Extras del Usuario en el Mes Actual</h2>
            <table class="table">
                <tr>
                    <th>Fecha de Creación</th>
                    <th>Cantidad de Horas</th>
                </tr>
                @foreach ($turnos_extras as $turnoExtra)
                    <tr>
                        <td>{{ $turnoExtra->created_at }}</td>
                        <td>{{ $turnoExtra->cantidad_horas }}</td>
                    </tr>
                @endforeach
            </table>

            <h2>Detalles de Turnos Extras</h2>
            <table class="table">
                <tr>
                    <th>Total Horas en Turnos Extras</th>
                    <th>Monto a Pagar por Turnos Extras</th>
                </tr>
                <tr>
                    <td>{{ $horas_turnos_extras }}</td>
                    <td>${{ $horas_turnos_extras * $monto_por_hora }}</td>
                </tr>
            </table>
        @endif
    @endif
@endsection
