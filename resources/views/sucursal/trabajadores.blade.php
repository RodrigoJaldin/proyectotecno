@extends('layouts.app')

@section('content')
    <h1>Trabajadores de la Sucursal {{ $sucursal->nombre }}</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>Rol</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($trabajadores as $trabajador)
                <tr>
                    <td>{{ $trabajador->name }}</td>
                    <td>{{ $trabajador->apellido }}</td>
                    <td>{{ $trabajador->email }}</td>
                    <td>{{ $trabajador->rol->tipo_rol }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
