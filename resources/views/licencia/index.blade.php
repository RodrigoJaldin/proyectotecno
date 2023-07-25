@extends('layouts.app')

@section('content')
    <h1>Lista de Licencias</h1>
    <br><br>
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#crearLicenciaModal">
        Crear Licencia
    </button>
    <table id="licencias" class="table table-striped table-bordered" style="width: 100%">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Fecha de Inicio</th>
                <th>Fecha Fin</th>
                <th>Tipo de Licencia</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($licencias as $licencia)
                <tr>
                    <td>{{ $licencia->id }}</td>
                    <td>{{ $licencia->fecha_inicio }}</td>
                    <td>{{ $licencia->fecha_fin }}</td>
                    <td>{{ $licencia->tipo_licencia }}</td>
                    <td>{{ $licencia->users->name }}</td>
                    <td>
                        <form class="formulario-eliminar" action="{{ route('licencia.destroy', $licencia->id) }}"
                            method="POST">
                            <button type="button" class="btn btn-info btn-editar" data-licencia-id="{{ $licencia->id }}"
                                data-toggle="modal" data-target="#editarLicenciaModal{{ $licencia->id }}">Editar</button>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>

                <div class="modal fade" id="editarLicenciaModal{{ $licencia->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editarLicenciaModalLabel{{ $licencia->id }}" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarLicenciaModalLabel{{ $licencia->id }}">Editar Licencia
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editarLicenciaForm{{ $licencia->id }}"
                                    action="{{ route('licencia.update', $licencia->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="fecha_inicio{{ $licencia->id }}">Fecha de Inicio</label>
                                        <input type="date" name="fecha_inicio" id="fecha_inicio{{ $licencia->id }}"
                                            class="form-control" value="{{ $licencia->fecha_inicio }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="fecha_fin{{ $licencia->id }}">Fecha Fin</label>
                                        <input type="date" name="fecha_fin" id="fecha_fin{{ $licencia->id }}"
                                            class="form-control" value="{{ $licencia->fecha_fin }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_licencia{{ $licencia->id }}">Tipo de Licencia</label>
                                        <input type="text" name="tipo_licencia" id="tipo_licencia{{ $licencia->id }}"
                                            class="form-control" value="{{ $licencia->tipo_licencia }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="id_user{{ $licencia->id }}">Usuario</label>
                                        <select name="id_user" id="id_user{{ $licencia->id }}" class="form-control"
                                            required>
                                            <option value="">Seleccionar Usuario</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $licencia->id_user == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Actualizar Licencia</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    @include('licencia.create')
@stop

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        $('#licencias').DataTable();
    </script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminada!',
                'La licencia ha sido eliminada exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire(
                'Exito!',
                'La licencia ha sido creada exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('edit-success'))
        <script>
            Swal.fire(
                'Exito!',
                'La licencia ha sido editada exitosamente',
                'success'
            )
        </script>
    @endif
    <script>
        $('.formulario-eliminar').submit(function(evento) {
            evento.preventDefault();

            Swal.fire({
                title: 'Estas seguro?',
                text: "La licencia se eliminara definitivamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })
        })
    </script>
@stop
