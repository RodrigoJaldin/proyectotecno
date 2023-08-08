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
                        @if (isset($user) && $user->rol->tipo_rol !== 'Gerente')
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
                        @elseif (isset($user) && $user->rol->tipo_rol === 'Gerente')
                            <!-- Solo botón de editar para el rol Gerente -->
                            <button type="button" class="btn btn-info btn-editar" data-user-id="{{ $user->id }}"
                                data-toggle="modal" data-target="#editarUserModal{{ $user->id }}">Editar</button>
                        @endif

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
                            <p style="color: #fff" class="card-text">{{ session('contadorVisitas') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.create')
    @if (isset($user))
        @include('user.edit')
        @include('horario_user.create') {{-- ASIGNAR HORARIO --}}
    @endif
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
