@extends('layouts.app')

@section('content')
    <button type="button" class="btn btn-primary" id="btnRegistrarAsistencia" data-toggle="modal"
        data-target="#modalRegistrarAsistencia">
        Registrar Asistencia
    </button>
    <button type="button" class="btn btn-primary" id="btnRegistrarSalida" data-toggle="modal"
        data-target="#modalRegistrarSalida">
        Registrar Salida
    </button>
    <br><br>
    <table id="asistencias" class="table table-striped table-bordered" style="width: 100%">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Fecha</th>
                <th>Hora Llegada</th>
                <th>Hora Salida</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($asistencias as $asistencia)
                <tr>
                    <td>{{ $asistencia->id }}</td>
                    <td>{{ $asistencia->users->name }}</td>
                    <td>{{ $asistencia->fecha }}</td>
                    <td>{{ $asistencia->hora_llegada }}</td>
                    <td>{{ $asistencia->hora_salida }}</td>

                </tr>
            @endforeach
        </tbody>
    </table>
    @include('asistencia.create')
    
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div style="position: fixed; bottom: 10px; right: 10px;">
                    <h2 style="font-size: 17px;">Visitas</h2>
                    <div class="card" style="width: 60px; height: 70px; font-size: 18px; background-color: #31525B;">
                        <div class="card-body">
                            <p style="color: #fff" class="card-text">{{ session('contadorVisitasAsistencia') }}</p>
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
        $('#asistencias').DataTable();
    </script>

    @if (session('success-llegada'))
        <script>
            Swal.fire(
                'Exito!',
                'Asistencia marcada exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('success-salida'))
        <script>
            Swal.fire(
                'Exito!',
                'Salida marcada exitosamente',
                'success'
            )
        </script>
    @endif
    <script>
        // Evento clic para registrar llegada
        $('#btnConfirmarLlegada').on('click', function(event) {
            event.preventDefault();
            var form = $(this).closest('form');
            form.submit(); // Enviar el formulario con una petición POST
        });

        // Evento clic para registrar salida
        $('#btnConfirmarSalida').on('click', function(event) {
            event.preventDefault();
            var form = $(this).closest('form');
            form.submit(); // Enviar el formulario con una petición POST
        });
    </script>

@stop
