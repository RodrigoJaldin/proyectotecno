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
                </tr>
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

@stop
