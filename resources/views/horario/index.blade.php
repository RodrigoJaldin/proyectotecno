@extends('layouts.app')


@section('content')
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#crearHorarioModal" >
        Crear Horario
    </button>
    <br> <br>
    <table id="roles" class="table table-striped table-bordered" style="width: 100%">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Turno</th>
                <th>Hora Entrada</th>
                <th>Hora Salida</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($horarios as $horario)
                <tr>
                    <td>{{ $horario->id ?? '--' }}</td>
                    <td>{{ $horario->turno ?? '--' }}</td>
                    <td>{{ $horario->hora_entrada ?? '--' }}</td>
                    <td>{{ $horario->hora_salida ?? '--' }}</td>

                    <td>
                        <form class="formulario-eliminar" action="{{ route('horario.destroy', $horario->id) }}"
                            method="POST">
                            <button type="button" class="btn btn-info btn-editar" data-horario-id="{{ $horario->id }}"
                                data-toggle="modal" data-target="#editarHorarioModal{{ $horario->id }}">Editar</button>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <!-- Modal Editar Horario -->
                <div class="modal fade" id="editarHorarioModal{{ $horario->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editarHorarioModal{{ $horario->id }}" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="editarHorarioModal{{ $horario->id }}">Editar Horario</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="editarHorarioForm{{ $horario->id }}"
                                action="{{ route('horario.update', $horario->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="turno{{ $horario->id }}">Turno:</label>
                                        <input type="text" class="form-control" id="turno{{ $horario->id }}"
                                            name="turno" value="{{ $horario->turno }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="hora_entrada{{ $horario->id }}">Hora de Entrada</label>
                                        <input type="time" class="form-control" id="hora_entrada{{ $horario->id }}"
                                            name="hora_entrada" value="{{ $horario->hora_entrada }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="hora_salida{{ $horario->id }}">Hora de Salida</label>
                                        <input type="time" class="form-control" id="hora_salida{{ $horario->id }}"
                                            name="hora_salida" value="{{ $horario->hora_salida }}">
                                    </div>

                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Cerrar</button>
                                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    @include('horario.create')
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div style="position: fixed; bottom: 10px; right: 10px;">
                    <h2 style="font-size: 17px;">Visitas</h2>
                    <div class="card bg-light" style="width: 120px; height: 80px; font-size: 14px;">
                        <div class="card-body">
                            <p class="card-text" style="font-size: 18px;">{{ session('contadorVisitasHorario') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El horario ha sido eliminado exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire(
                'Exito!',
                'El horario ha sido creado exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('edit-success'))
        <script>
            Swal.fire(
                'Exito!',
                'El horario ha sido editado exitosamente',
                'success'
            )
        </script>
    @endif
    <script>
        $('.formulario-eliminar').submit(function(evento) {
            evento.preventDefault();

            Swal.fire({
                title: 'Estas seguro?',
                text: "Este horario se eliminara definitivamente",
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
