@extends('layouts.app')

@section('content')

    <br> <br>
    <table id="user_horarios" class="table table-striped table-bordered" style="width: 100%">
        <thead class="bg-primary text-white">
            <tr>
                <th>Usuario</th>
                <th>Dia Laboral</th>
                <th>Horario</th>
                <th>Hora Entrada</th>
                <th>Hora Salida</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($userHorarios as $userHorario)
                <tr>
                    <td>{{ $userHorario->users->name ?? '--' }}</td>
                    <td>{{ $userHorario->dia_laboral ?? '--' }}</td>
                    <td>{{ $userHorario->horario->turno ?? '--' }}</td>
                    <td>{{ $userHorario->horario->hora_entrada ?? '--' }}</td>
                    <td>{{ $userHorario->horario->hora_salida ?? '--' }}</td>
                    <td>
                        @if (Auth::user()->rol->tipo_rol === 'Gerente')
                            <form class="formulario-eliminar" action="{{ route('horario_user.destroy', $userHorario->id) }}"
                                method="POST">
                                <button type="button" class="btn btn-info btn-editar"
                                    data-userHorario-id="{{ $userHorario->id }}" data-toggle="modal"
                                    data-target="#editarHorarioUserModal{{ $userHorario->id }}">Editar</button>

                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        @endif

                    </td>
                </tr>

                <!-- Modal para editar horario asignado -->
                <div class="modal fade" id="editarHorarioUserModal{{ $userHorario->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editarHorarioUserModalLabel{{ $userHorario->id }}" aria-hidden="true"
                    data-backdrop="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarHorarioUserModalLabel{{ $userHorario->id }}">Editar
                                    Horario Asignado</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editarHorarioForm{{ $userHorario->id }}"
                                    action="{{ route('horario_user.update', $userHorario->id) }}" method="POST">
                                    @csrf
                                    @method('PUT') <!-- Usar el método PUT para actualizar -->

                                    <input type="hidden" id="editUserHorarioId" name="editUserHorarioId"
                                        value="{{ $userHorario->id_user }}">
                                    <div class="form-group">
                                        <label for="editHorarioId{{ $userHorario->id_horario }}">Seleccionar
                                            Horario</label>
                                        <select class="form-control" id="editHorarioId{{ $userHorario->id_horario }}"
                                            name="editHorarioId">
                                            @foreach ($horarios as $horario)
                                                <option value="{{ $horario->id }}"
                                                    @if ($userHorario->id_horario === $horario->id) selected @endif>
                                                    {{ $horario->turno }} - {{ $horario->hora_entrada }} a
                                                    {{ $horario->hora_salida }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="editDiaLaboral{{ $userHorario->dia_laboral }}">Seleccionar Día
                                            Laboral</label>
                                        <select class="form-control" id="editDiaLaboral{{ $userHorario->id }}"
                                            name="editDiaLaboral">
                                            <option value="Lunes" @if ($userHorario->dia_laboral === 'Lunes') selected @endif>Lunes
                                            </option>
                                            <option value="Martes" @if ($userHorario->dia_laboral === 'Martes') selected @endif>Martes
                                            </option>
                                            <option value="Miércoles" @if ($userHorario->dia_laboral === 'Miércoles') selected @endif>
                                                Miércoles</option>
                                            <option value="Jueves" @if ($userHorario->dia_laboral === 'Jueves') selected @endif>Jueves
                                            </option>
                                            <option value="Viernes" @if ($userHorario->dia_laboral === 'Viernes') selected @endif>
                                                Viernes</option>
                                            <option value="Sábado" @if ($userHorario->dia_laboral === 'Sábado') selected @endif>Sábado
                                            </option>
                                            <option value="Domingo" @if ($userHorario->dia_laboral === 'Domingo') selected @endif>
                                                Domingo</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div style="position: fixed; bottom: 10px; right: 10px;">
                    <h2 style="font-size: 17px;">Visitas</h2>
                    <div class="card" style="width: 60px; height: 70px; font-size: 18px; background-color: #31525B;">
                        <div class="card-body">
                            <p style="color: #fff" class="card-text">{{ session('contadorVisitasRol') }}</p>
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
        $('#user_horarios').DataTable();
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
    @if (session('edit-success'))
        <script>
            Swal.fire(
                'Exito!',
                'El horario ha sido modificado xitosamente',
                'success'
            )
        </script>
    @endif
@stop
