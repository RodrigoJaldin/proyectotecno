@extends('layouts.app')

@section('content')
    <button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#crearUserModal" data-backdrop="false">
        Crear Usuario
    </button>

    <br> <br>
    <table id="users" class="table table-striped table-bordered" style="width: 100%">
        <thead class="bg-primary text-white">
            <tr>
                <th>ID</th>
                <th>Codigo</th>
                <th>Nombre</th>
                <th>Apellido</th>
                <th>Email</th>
                <th>CI</th>
                <th>Foto</th>
                <th>Rol</th>
                <th>Telefono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($users as $user)
                <tr>
                    <td>{{ $user->id ?? '--' }}</td>
                    <td>{{ $user->codigo_empleado ?? '--' }}</td>
                    <td>{{ $user->name ?? '--' }}</td>
                    <td>{{ $user->apellido ?? '--' }}</td>
                    <td>{{ $user->email ?? '--' }}</td>
                    <td>{{ $user->ci ?? '--' }}</td>
                    <td>
                        @if ($user->foto_user)
                            <img src="{{ asset($user->foto_user) }}" alt="Foto del Usuario" width="70" height="70">
                        @else
                            <p>No se ha cargado ninguna foto del usuario</p>
                        @endif
                    </td>
                    <td>{{ $user->rol->tipo_rol ?? '--' }}</td>
                    <td>{{ $user->telefono ?? '--' }}</td>
                    <td>
                        @if ($user->rol->tipo_rol !== 'Gerente')
                            <!-- Formulario para editar y eliminar usuarios -->
                            <form class="formulario-eliminar" action="{{ route('user.destroy', $user->id) }}"
                                method="POST">
                                <button type="button" class="btn btn-info btn-editar" data-user-id="{{ $user->id }}"
                                    data-toggle="modal" data-target="#editarUserModal{{ $user->id }}">Editar</button>
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                <!-- Botón para ver horario -->
                                <a href="{{ route('horario_user.showUserHorarios', ['user_id' => $user->id]) }}"
                                    class="btn btn-primary">Ver Horario</a>
                                <!-- Enlace para calcular nómina -->
                                <a href="{{ route('nomina.show', ['user_id' => $user->id]) }}" class="btn btn-primary">
                                    Calcular Nómina
                                </a>
                                <!-- Botón para asignar horario -->
                                <button type="button" class="btn btn-primary btn-asignar-horario"
                                    data-user-id="{{ $user->id }}" data-toggle="modal"
                                    data-target="#asignarHorarioModal">Asignar Horario</button>
                            </form>
                        @endif
                    </td>
                </tr>
                <!-- Modal para asignar horario a un usuario -->
                <div class="modal fade" id="asignarHorarioModal" tabindex="-1" role="dialog"
                    aria-labelledby="asignarHorarioModalLabel" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="asignarHorarioModalLabel">Asignar Horario</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <form id="asignarHorarioForm" action="{{ route('asignarHorario') }}" method="POST">
                                    @csrf
                                    <input type="hidden" id="userId" name="userId" value="{{ $user->id }}">


                                    <div class="form-group">
                                        <label for="horario_id">Seleccionar Horario</label>
                                        <select class="form-control" id="horario_id" name="horario_id">
                                            @foreach ($horarios as $horario)
                                                <option value="{{ $horario->id }}">{{ $horario->turno }} -
                                                    {{ $horario->hora_entrada }} a {{ $horario->hora_salida }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="dia_laboral">Seleccionar Día Laboral</label>
                                        <select class="form-control" id="dia_laboral" name="dia_laboral">
                                            <option value="Lunes">Lunes</option>
                                            <option value="Martes">Martes</option>
                                            <option value="Miércoles">Miércoles</option>
                                            <option value="Jueves">Jueves</option>
                                            <option value="Viernes">Viernes</option>
                                            <option value="Sábado">Sábado</option>
                                            <option value="Domingo">Domingo</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Asignar</button>
                                </form>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Editar Usuario -->
                <div class="modal fade" id="editarUserModal{{ $user->id }}" tabindex="-1" role="dialog"
                    aria-labelledby="editarUserModal{{ $user->id }}" aria-hidden="true" data-backdrop="false">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h2 class="modal-title" id="editarUserModal{{ $user->id }}">Editar Usuario</h2>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form id="editarUserForm{{ $user->id }}" action="{{ route('user.update', $user->id) }}"
                                method="POST" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="form-group">
                                        <label for="codigo_empleado{{ $user->id }}">Codigo:</label>
                                        <input type="text" class="form-control"
                                            id="codigo_empleado{{ $user->id }}" name="codigo_empleado"
                                            value="{{ $user->codigo_empleado }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="name{{ $user->id }}">Nombre:</label>
                                        <input type="text" class="form-control" id="name{{ $user->id }}"
                                            name="name" value="{{ $user->name }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="apellido{{ $user->id }}">Apellido:</label>
                                        <input type="text" class="form-control" id="apellido{{ $user->id }}"
                                            name="apellido" value="{{ $user->apellido }}">
                                    </div>

                                    <div class="form-group">
                                        <label for="email{{ $user->id }}">Correo Electrónico:</label>
                                        <input type="email" class="form-control" id="email{{ $user->id }}"
                                            name="email" value="{{ $user->email }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="ci{{ $user->id }}">Carnet:</label>
                                        <input type="text" class="form-control" id="ci{{ $user->id }}"
                                            name="ci" value="{{ $user->ci }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="telefono{{ $user->id }}">Telefono:</label>
                                        <input type="text" class="form-control" id="telefono{{ $user->id }}"
                                            name="telefono" value="{{ $user->telefono }}">
                                    </div>

                                    <div class="mb-3">
                                        <label for="foto_user" class="form-label">{{ __('Foto del Usuario') }}</label>
                                        <input type="file" id="foto_user" class="form-control" name="foto_user">
                                    </div>

                                    @if ($user->foto_user)
                                        <div class="mb-3">
                                            <img src="{{ asset($user->foto_user) }}" alt="Foto del Usuario"
                                                style="max-width: 100px; height: auto;">
                                        </div>
                                    @endif

                                    <!-- Agregar campo select para los roles -->
                                    <div class="form-group">
                                        <label for="id_rol{{ $user->id }}">Rol:</label>
                                        <select class="form-control" id="rol{{ $user->id }}" name="id_rol">
                                            @foreach ($roles as $rol)
                                                <option value="{{ $rol->id }}"
                                                    @if ($user->id_rol === $rol->id) selected @endif>
                                                    {{ $rol->tipo_rol }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <!-- Agregar campo select para las sucursales -->
                                    <div class="form-group">
                                        <label for="id_sucursal{{ $user->id }}">Sucursal:</label>
                                        <select class="form-control" id="rol{{ $user->id }}" name="id_sucursal">
                                            @foreach ($sucursales as $sucursal)
                                                <option value="{{ $sucursal->id }}"
                                                    @if ($user->id_sucursal === $sucursal->id) selected @endif>
                                                    {{ $sucursal->nombre }}
                                                </option>
                                            @endforeach
                                        </select>
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
    <div class="container mt-5">
        <div class="row">
            <div class="col">
                <div style="position: fixed; bottom: 10px; right: 10px;">
                    <h2 style="font-size: 17px;">Visitas</h2>
                    <div class="card" style="width: 60px; height: 70px; font-size: 18px; background-color: #31525B;">
                        <div class="card-body">
                            <p style="color: #fff" class="card-text">{{ session('contadorVisitas') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.create')
    {{-- @include('user.edit') --}}
   {{--  @include('horario_user.create') --}} {{-- ASIGNAR HORARIO --}}

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
        $('#users').DataTable();

        $('.formulario-eliminar').submit(function(evento) {
            evento.preventDefault();

            Swal.fire({
                title: 'Estas seguro?',
                text: "Este horario asignado se eliminara",
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
    @if (session('eliminar') == 'ok')
        <script>
            Swal.fire(
                'Eliminado!',
                'El usuario ha sido eliminado exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('success'))
        <script>
            Swal.fire(
                'Exito!',
                'El usuario ha sido creado exitosamente',
                'success'
            )
        </script>
    @endif
    @if (session('success-horario-asignado'))
        <script>
            Swal.fire(
                'Exito!',
                'El horario se ha asignado exitosamente',
                'success'
            )
        </script>
    @endif

    @if (session('error-horario-existente'))
        <script>
            Swal.fire(
                'Error',
                '{{ session('error-horario-existente') }}',
                'error'
            )
        </script>
    @endif

    @if (session('edit-success'))
        <script>
            Swal.fire(
                'Exito!',
                'El usuario ha sido editado exitosamente',
                'success'
            )
        </script>
    @endif
    <script>
        $(document).ready(function() {
            // Evento click para el botón de "Asignar Horario"
            $('.btn-asignar-horario').on('click', function() {
                var userId = $(this).data('user-id'); // Obtener el id del usuario desde el botón
                $('#userId').val(userId); // Asignar el id del usuario al campo "userId" del formulario
            });
        });

        $('.formulario-eliminar').submit(function(evento) {
            evento.preventDefault();

            Swal.fire({
                title: 'Estas seguro?',
                text: "Este usuario se eliminara definitivamente",
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
            var userId = $(this).data('user-id');
            $('#editarUserForm' + userId).validate({
                rules: {
                    nombre: {
                        required: true,
                        minlength: 1
                    },
                    apellido: {
                        required: true,
                        minlength: 1
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    ci: {
                        required: true,
                        minlength: 1
                    },
                    telefono: {
                        required: true,
                        minlength: 1
                    }
                },
                messages: {
                    nombre: {
                        required: 'Ingrese un nombre',
                        minlength: 'Ingrese al menos 1 carácter'
                    },
                    apellido: {
                        required: 'Ingrese un apellido',
                        minlength: 'Ingrese al menos 1 carácter'
                    },
                    email: {
                        required: 'Ingrese un correo electrónico',
                        email: 'Ingrese un correo electrónico válido'
                    },
                    ci: {
                        required: 'Ingrese un número de carnet',
                        minlength: 'Ingrese al menos 1 carácter'
                    },
                    telefono: {
                        required: 'Ingrese un número de celular',
                        minlength: 'Ingrese al menos 1 carácter'
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>




@stop
