<!-- resources/views/documento/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Lista de Documentos</h1>
    <a href="{{ route('documento.create') }}" class="btn btn-primary">Crear Nuevo Documento</a>
    <table class="table">
        <thead>
            <tr>
                <th>Descripción</th>
                <th>Tipo de Documento</th>
                <th>Archivo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($documentos as $documento)
                <tr>
                    <td>{{ $documento->descripcion }}</td>
                    <td>{{ $documento->tipo_documento }}</td>
                    <td>
                        @if ($documento->archivo)
                            <a href="{{ asset($documento->archivo) }}" target="_blank">Ver Archivo</a>
                        @else
                            Sin Archivo Adjunto
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('documento.edit', $documento) }}" class="btn btn-info">Editar</a>
                        <form action="{{ route('documento.destroy', $documento) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este documento?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
