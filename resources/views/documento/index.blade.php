<!-- resources/views/documento/index.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Lista de Documentos</h1>
    <br><br>
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#crearDocumentoModal">
        Crear Documento
    </button>
    <br><br>
    <table id="documentos" class="table table-striped table-bordered" style="width: 100%">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Descripcion</th>
                <th>Tipo Documento</th>
                <th>Archivo</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($documentos as $documento)
                <tr>
                    <td>{{ $documento->id }}</td>

                    <td>{{ $documento->users->name }} {{ $documento->users->apellido }}</td>
                    <td>{{ $documento->descripcion }}</td>
                    <td>{{ $documento->tipo_documento }}</td>
                    <td>
                        @if ($documento->archivo)
                            <a href="{{ asset($documento->archivo) }}" target="_blank">Descargar Archivo</a>
                        @else
                            Sin Archivo Adjunto
                        @endif
                    </td>
                    <td>
                        <form class="formulario-eliminar" action="{{ route('documento.destroy', $documento->id) }}"
                            method="POST">
                            <button type="button" class="btn btn-info btn-editar" data-documento-id="{{ $documento->id }}"
                                data-toggle="modal" data-target="#editarDocumentoModal{{ $documento->id }}">Editar</button>

                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
                <!-- ... -->
                <div class="modal fade" id="editarDocumentoModal{{ $documento->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editarDocumentoModalLabel{{ $documento->id }}" aria-hidden="true"
                    data-backdrop="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editarDocumentoModalLabel{{ $documento->id }}">Editar Documento
                                </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="editarDocumentoForm{{ $documento->id }}"
                                    action="{{ route('documento.update', $documento->id) }}" method="POST"
                                    enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="descripcion{{ $documento->id }}">Descripción</label>
                                        <input type="text" name="descripcion" id="descripcion{{ $documento->id }}"
                                            class="form-control" value="{{ $documento->descripcion }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="tipo_documento{{ $documento->id }}">Tipo de Documento</label>
                                        <input type="text" name="tipo_documento" id="tipo_documento{{ $documento->id }}"
                                            class="form-control" value="{{ $documento->tipo_documento }}" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="archivo{{ $documento->id }}">Archivo</label>
                                        <input type="file" name="archivo" id="archivo{{ $documento->id }}"
                                            class="form-control-file">
                                    </div>
                                    <div class="form-group">
                                        <label for="id_user{{ $documento->id }}">Usuario</label>
                                        <select name="id_user" id="id_user{{ $documento->id }}" class="form-control"
                                            required>
                                            <option value="">{{ $documento->users->name }}</option>
                                            @foreach ($users as $user)
                                                <option value="{{ $user->id }}"
                                                    {{ $documento->id_user == $user->id ? 'selected' : '' }}>
                                                    {{ $user->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <button type="submit" class="btn btn-primary">Actualizar Documento</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </tbody>
    </table>
    @include('documento.create')

    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div style="position: fixed; bottom: 10px; right: 10px;">
                    <h2 style="font-size: 17px;">Visitas</h2>
                    <div class="card" style="width: 60px; height: 70px; font-size: 18px; background-color: #31525B;">
                        <div class="card-body">
                            <p style="color: #fff" class="card-text">{{ session('contadorVisitasDocumento') }}</p>
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
        $('#documentos').DataTable();
    </script>
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El documento ha sido eliminado exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire(
                'Exito!',
                'El documento ha sido creado exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('edit-success'))
        <script>
            Swal.fire(
                'Exito!',
                'El documento ha sido editado exitosamente',
                'success'
            )
        </script>
    @endif
    <script>
        $('.formulario-eliminar').submit(function(evento) {
            evento.preventDefault();

            Swal.fire({
                title: 'Estas seguro?',
                text: "Este documento se eliminara definitivamente",
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
            var documentoId = $(this).data('documento-id');
            var descripcion = $(this).closest('tr').find('td:eq(2)').text();
            var tipoDocumento = $(this).closest('tr').find('td:eq(3)').text();

            $('#editarDocumentoForm' + documentoId).attr('action', "{{ route('documento.update', '') }}" + "/" +
                documentoId);
            $('#descripcion' + documentoId).val(descripcion);
            $('#tipo_documento' + documentoId).val(tipoDocumento);

            // Aquí puedes seguir con el código para el campo de usuario (select)
            // Por ejemplo:
            var userId = $(this).closest('tr').find('td:eq(1)').data('user-id');
            $('#id_user' + documentoId).val(userId);
        });
    </script>

@stop
