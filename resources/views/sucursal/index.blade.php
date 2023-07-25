@extends('layouts.app')

@section('content')
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#modalCrearSucursal">
        Crear Sucursal
    </button>
    <br><br>
    <table id="sucursales" class="table table-striped table-bordered" style="width: 100%">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Dirección</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($sucursales as $sucursal)
                <tr>
                    <td>{{ $sucursal->id }}</td>
                    <td>{{ $sucursal->nombre }}</td>
                    <td>{{ $sucursal->direccion }}</td>
                    <td>
                        <form class="formulario-eliminar" action="{{ route('sucursal.destroy', $sucursal->id) }}"
                            method="POST">

                            @if ($sucursales->count() > 0)
                                <button type="button" class="btn btn-info btn-editar"
                                    data-sucursal-id="{{ $sucursal->id }}" data-toggle="modal"
                                    data-target="#editarSucursalModal{{ $sucursal->id }}">Editar</button>
                            @endif


                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <!-- Modal Editar Sucursal -->
                <div class="modal fade" id="editarSucursalModal{{ $sucursal->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editarSucursalModal{{ $sucursal->id }}" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="editarSucursalModal{{ $sucursal->id }}">Editar Sucursal</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="editarSucursalForm{{ $sucursal->id }}"
                                action="{{ route('sucursal.update', $sucursal->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="nombre{{ $sucursal->id }}">Nombre:</label>
                                        <input type="text" class="form-control" id="nombre{{ $sucursal->id }}"
                                            name="nombre" value="{{ $sucursal->nombre }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="direccion{{ $sucursal->id }}">Direccion:</label>
                                        <input type="text" class="form-control" id="direccion{{ $sucursal->id }}"
                                            name="direccion" value="{{ $sucursal->direccion }}">
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
    @include('sucursal.create')
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
        $('#sucursales').DataTable();
    </script>

    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'La sucursal ha sido eliminada exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire(
                'Exito!',
                'La sucursal ha sido creada exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('edit-success'))
        <script>
            Swal.fire(
                'Exito!',
                'La sucursal ha sido editado exitosamente',
                'success'
            )
        </script>
    @endif
    <script>
        $('.formulario-eliminar').submit(function(evento) {
            evento.preventDefault();

            Swal.fire({
                title: 'Estas seguro?',
                text: "Esta sucursal se eliminara definitivamente",
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



        $('.btn-editar').on('click', function() {
            var sucursalId = $(this).data('sucursal-id');
            var nombre = $(this).closest('tr').find('td:eq(1)').text();
            var direccion = $(this).closest('tr').find('td:eq(2)').text();

            $('#editarSucursalForm').attr('action', "{{ route('sucursal.update', '') }}" + "/" + sucursalId);
            $('#nombre_editar').val(nombre);
            $('#direccion_editar').val(direccion);
        });
    </script>
@stop
