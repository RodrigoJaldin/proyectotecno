@extends('layouts.app')

@section('content')
<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#crearUserModal">
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
                    <td>{{ $user->rol->tipo_rol ?? '--' }}</td>
                    <td>{{ $user->telefono ?? '--' }}</td>
                    <td>
                        <form class="formulario-eliminar" action="{{ route('user.destroy', $user->id) }}" method="POST">

                            <button type="button" class="btn btn-info btn-editar" data-user-id="{{ $user->id }}"
                                data-toggle="modal" data-target="#editarUserModal{{ $user->id }}">Editar</button>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    @include('user.create')
    @include('user.edit')
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
        $('#users').DataTable();
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
                    celular: {
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
                    celular: {
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
