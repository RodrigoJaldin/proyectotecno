@extends('layouts.app')


@section('content')
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#crearRolModal">
        Crear Rol
    </button>
    <br> <br>
    <table id="roles" class="table table-striped table-bordered" style="width: 100%">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Tipo Rol</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($roles as $rol)
                <tr>
                    <td>{{ $rol->id ?? '--' }}</td>
                    <td>{{ $rol->tipo_rol ?? '--' }}</td>
                    <td>
                        @if ($rol->tipo_rol !== 'Gerente')
                            <form class="formulario-eliminar" action="{{ route('rol.destroy', $rol->id) }}" method="POST">
                                <button type="button" class="btn btn-info btn-editar" data-rol-id="{{ $rol->id }}"
                                    data-toggle="modal" data-target="#editarRolModal{{ $rol->id }}">Editar</button>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('rol.edit')
    @include('rol.create')

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
        $('#roles').DataTable();
    </script>


@stop
