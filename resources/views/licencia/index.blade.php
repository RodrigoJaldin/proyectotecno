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
                <th>Estado</th>
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
                    <td>
                        @if ($licencia->estado === 'aceptar')
                            Aceptada
                        @elseif ($licencia->estado === 'rechazar')
                            Rechazada
                        @else
                            {{ $licencia->estado }}
                        @endif
                    </td>
                    <td>{{ $licencia->users->name }} {{ $licencia->users->apellido }}</td>
                    <td>
                        @if (Auth::user()->rol->tipo_rol === 'Gerente')
                            <button type="button" class="btn btn-info btn-editar" data-licencia-id="{{ $licencia->id }}"
                                data-toggle="modal" data-target="#editarLicenciaModal{{ $licencia->id }}">Editar</button>
                        @endif
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
                                        <label for="estado{{ $licencia->id }}">Estado</label>
                                        <select name="estado" id="estado{{ $licencia->id }}" class="form-control"
                                            required>
                                            <option value="aceptar"
                                                {{ $licencia->estado === 'aceptar' ? 'selected' : '' }}>Aceptar</option>
                                            <option value="rechazar"
                                                {{ $licencia->estado === 'rechazar' ? 'selected' : '' }}>Rechazar</option>
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

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div style="position: fixed; bottom: 10px; right: 10px;">
                    <h2 style="font-size: 17px;">Visitas</h2>
                    <div class="card" style="width: 60px; height: 70px; font-size: 18px; background-color: #31525B;">
                        <div class="card-body">
                            <p style="color: #fff" class="card-text">{{ session('contadorVisitasLicencia') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

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
