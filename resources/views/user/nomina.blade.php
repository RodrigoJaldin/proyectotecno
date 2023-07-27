@extends('layouts.app')

@section('content')
    <h1>Nómina de Usuarios</h1>

    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <!-- Agrega más columnas según tus necesidades -->
                <th>Monto por Hora</th>
                <th>Horas Trabajadas</th>
                <th>Minutos de Retraso</th>
                <th>Sueldo con Descuentos</th>
                <th>Monto de Horas Extras</th>
                <th>Total a Pagar</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <!-- Muestra los datos del usuario seleccionado -->
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->apellido }}</td>
                <td>{{ $usuario->email }}</td>
                <!-- Agrega más columnas según tus necesidades -->
                <td>${{ $usuario->nomina['montoPorHora'] }}</td>
                <td>{{ $usuario->nomina['horasTrabajadas'] }}</td>
                <td>{{ $usuario->nomina['minutosRetraso'] }}</td>
                <td>${{ $usuario->nomina['sueldoConDescuentos'] }}</td>
                <td>${{ $usuario->nomina['montoHorasExtras'] }}</td>
                <td>${{ $usuario->nomina['totalAPagar'] }}</td>
            </tr>
        </tbody>
    </table>
@endsection
