<!-- resources/views/documento/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Lista de Documentos</h1>
    <br><br>
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#crearDocumentoModal">
        Crear Documento
    </button>
    <br><br>
    <table id="documentos" class="table table-striped table-bordered" style="width: 100%">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Descripcion</th>
                <th>Tipo Documento</th>
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
                            <a href="{{ asset($documento->archivo) }}" target="_blank">Descargar Archivo</a>
                        @else
                            Sin Archivo Adjunto
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('documento.edit', $documento) }}" class="btn btn-info">Editar</a>
                        <form action="{{ route('documento.destroy', $documento) }}" method="POST"
                            style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Estás seguro de eliminar este documento?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('documento.create')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        $('#documentos').DataTable();
    </script>


@stop
