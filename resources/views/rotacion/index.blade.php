@extends('layouts.app')

@section('content')
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#crearRotacionModal">
        Registrar Rotacion
    </button>
    <br> <br>
    <table id="rotaciones" class="table table-striped table-bordered" style="width: 100%">
        <thead class="bg-primary text-white">
            <tr>
                <th>Usuario Solicitante</th>
                <th>Usuario Reemplazante</th>
                <th>Fecha</th>
                <th>Horario</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($rotaciones as $rotacion)
                <tr>
                    <td>{{ $rotacion->usuarioSolicitante->name }}</td>
                    <td>{{ $rotacion->usuarioReemplazante->name }}</td>
                    <td>{{ $rotacion->fecha }}</td>
                    <td>{{ $rotacion->horario->turno }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <!-- Modal Crear Rotación -->
    <div class="modal fade" id="crearRotacionModal" tabindex="-1" role="dialog" aria-labelledby="crearRotacionModalLabel"
        aria-hidden="true" data-backdrop="false">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="crearRotacionModalLabel">Registrar Rotación</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="{{ route('rotacion.store') }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="usuario_solicitante">Usuario Solicitante:</label>
                            <select class="form-control" id="usuario_solicitante" name="usuario_solicitante" required>
                                <!-- Aquí debes mostrar la lista de usuarios que pueden ser solicitantes -->
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="usuario_reemplazante">Usuario Reemplazante:</label>
                            <select class="form-control" id="usuario_reemplazante" name="usuario_reemplazante" required>
                                <!-- Aquí debes mostrar la lista de usuarios que pueden ser reemplazantes -->
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fecha">Fecha:</label>
                            <input type="date" class="form-control" id="fecha" name="fecha" required>
                        </div>
                        <div class="form-group">
                            <label for="id_horario">Horario:</label>
                            <select class="form-control" id="id_horario" name="id_horario" required>
                                <!-- Aquí debes mostrar la lista de horarios disponibles -->
                                @foreach ($horarios as $horario)
                                    <option value="{{ $horario->id }}">{{ $horario->turno }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>



    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div style="position: fixed; bottom: 10px; right: 10px;">
                    <h2 style="font-size: 17px;">Visitas</h2>
                    <div class="card" style="width: 60px; height: 70px; font-size: 18px; background-color: #31525B;">
                        <div class="card-body">
                            <p style="color: #fff" class="card-text">{{ session('contadorVisitasRotacion') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
@endsection

@section('js')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

    <script>
        $('#rotaciones').DataTable();

        $('.formulario-eliminar').submit(function(evento) {
            evento.preventDefault();

            Swal.fire({
                title: 'Estas seguro?',
                text: "Este rol se eliminara definitivamente",
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
        });
    </script>
@endsection
