@extends('layouts.app')


@section('content')
    @if (Auth::user()->rol->tipo_rol === 'Gerente')
        <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#crearContratoModal">
            Crear Contrato
        </button>
    @endif


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
                {{-- <th>Acciones</th> --}}
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
                        @if (Auth::user()->rol->tipo_rol === 'Gerente')
                            <form class="formulario-eliminar" action="{{ route('contratos.destroy', $contrato) }}"
                                method="POST">
                                <a href="{{ route('contratos.edit', $contrato) }}" class="btn btn-primary">Editar</a>
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
    @include('contrato.create')

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div style="position: fixed; bottom: 10px; right: 10px;">
                    <h2 style="font-size: 17px;">Visitas</h2>
                    <div class="card" style="width: 60px; height: 70px; font-size: 18px; background-color: #31525B;">
                        <div class="card-body">
                            <p style="color: #fff" class="card-text">{{ session('contadorVisitasContrato') }}</p>
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
