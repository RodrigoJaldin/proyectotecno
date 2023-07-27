@extends('layouts.app')


@section('content')
<a href="{{ route('contratos.create') }}" class="btn btn-primary mb-3">Crear Contrato</a>

    <br> <br>
    <table id="contratos" class="table table-striped table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th>ID</th>
                <th>Horas Laborales</th>
                <th>Fecha Inicio</th>
                <th>Fecha Fin</th>
                <th>Sueldo</th>
                <th>Usuario</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($contratos as $contrato)
                <tr>
                    <td>{{ $contrato->id }}</td>
                    <td>{{ $contrato->horas_laborales }}</td>
                    <td>{{ $contrato->fecha_inicio }}</td>
                    <td>{{ $contrato->fecha_fin }}</td>
                    <td>{{ $contrato->sueldo }}</td>
                    <td>{{ $contrato->user->name }}</td>
                    <td>
                        {{-- <a href="{{ route('contratos.show', $contrato) }}" class="btn btn-info">Ver</a> --}}
                        <a href="{{ route('contratos.edit', $contrato) }}" class="btn btn-primary">Editar</a>
                        <form action="{{ route('contratos.destroy', $contrato) }}" method="POST" style="display: inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Estás seguro de eliminar este contrato?')">Eliminar</button>
                        </form>
                    </td>
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
        $('#contratos').DataTable();

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
                'El contrato ha sido eliminado exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire(
                'Exito!',
                'El contrato ha sido creado exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('edit-success'))
        <script>
            Swal.fire(
                'Exito!',
                'El contrato ha sido editado exitosamente',
                'success'
            )
        </script>
    @endif
@stop
