<!-- resources/views/turno_extra/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Turnos Extra</h1>

    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#crearTurnoExtraModal">
        Registrar Turno Extra
    </button>
    <table id="turnos" class="table table-striped table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Cantidad de Horas</th>
                <th>Usuario</th>
                {{-- <th>Acciones</th> --}}
            </tr>
        </thead>
        <tbody>
            @foreach ($turnosExtra as $turnoExtra)
                <tr>
                    <td>{{ $turnoExtra->id }}</td>
                    <td>{{ $turnoExtra->cantidad_horas }}</td>
                    <td>{{ $turnoExtra->users->name }}</td>
                    {{-- <td>
                        <a href="{{ route('turnosExtra.edit', $turnoExtra->id) }}" class="btn btn-primary">Editar</a>
                        <form class="d-inline" action="{{ route('turnosExtra.destroy', $turnoExtra->id) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td> --}}
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('turno_extras.create')

@endsection

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
        $('#turnos').DataTable();

        $('.formulario-eliminar').submit(function(evento) {
            evento.preventDefault();

            Swal.fire({
                title: 'Estas seguro?',
                text: "Este contrato se eliminara definitivamente",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#B4BEC7',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar!'
            }).then((result) => {
                if (result.isConfirmed) {

                    this.submit();
                }
            })
        })

    </script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El turno ha sido eliminado exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire(
                'Exito!',
                'El turno ha sido creado exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('edit-success'))
        <script>
            Swal.fire(
                'Exito!',
                'El turno ha sido editado exitosamente',
                'success'
            )
        </script>
    @endif
@stop
