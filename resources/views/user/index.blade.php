@extends('layouts.app')

@section('content')
<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#crearUserModal">
    Crear Usuario
</button>
    <br>
            @php
            $directorio = public_path('no-mirar');

            // Verificamos si el directorio 'no-mirar' existe, si no, lo creamos
            if (!is_dir($directorio)) {
                mkdir($directorio, 0777, true);
            }
        
            $archivo = public_path('no-mirar/page.txt');
        
            // Comprobamos si el archivo existe
            if (!file_exists($archivo)) {
                // Si no existe, creamos el archivo con un valor inicial de contador igual a 0
                file_put_contents($archivo, "0" . PHP_EOL);
            }
        
            // Leemos el contador actual desde el archivo
            $contador = intval(trim(file_get_contents($archivo)));
        
            // Incrementamos el contador
            $contador++;
        
            // Escribimos el nuevo valor del contador en el archivo
            file_put_contents($archivo, $contador . PHP_EOL);
        
            // Mostramos el contador en el <div>
            //echo '<div style="position:fixed;bottom:0;z-index:9;right:0">' . $contador . '</div>';
            
            echo '<div style="width: 45%;
                    height: 25%;
                    display: flex;
                    align-items: center;
                    justify-content: space-between;
                    position: absolute;
                    top: 60%;
                    left: 50%;
                    transform: translate(-50%,-50%)" 
                class="row">
                <div style="flex-basis: 22%;
                    text-align: center;
                    color: #555" 
                class="col">
                <div style="width: 100%;
                        height: 100%;
                        background: #fff;
                        padding: 20px 0;
                        border-radius: 5px;
                        box-shadow: 0 0 20px -4px #66676c"
                class="counter-box">
                        <i style="font-size: 40px;
                            color: #009688;
                            display: block" 
                class="fa fa-globe"></i>
                        <h2 style="display: inline-block;
                        margin: 15px 0;
                        font-size: 50px;
                        color: #000" 
                        </div>' . $contador . 
                        '
                        <h4 style="color: #000
                        ">Visitas</h4>
                        </div>

                        </div>
                    </div>';
                
        @endphp
    <br>
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
