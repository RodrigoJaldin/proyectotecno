<!-- Modal Editar Usuario -->
<div class="modal fade" id="editarUserModal{{ $user->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editarUserModal{{ $user->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="editarUserModal{{ $user->id }}">Editar Usuario</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editarUserForm{{ $user->id }}" action="{{ route('user.update', $user->id) }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="codigo_empleado{{ $user->id }}">Codigo:</label>
                        <input type="text" class="form-control" id="codigo_empleado{{ $user->id }}"
                            name="codigo_empleado" value="{{ $user->codigo_empleado }}">
                    </div>
                    <div class="form-group">
                        <label for="name{{ $user->id }}">Nombre:</label>
                        <input type="text" class="form-control" id="name{{ $user->id }}" name="name"
                            value="{{ $user->name }}">
                    </div>
                    <div class="form-group">
                        <label for="apellido{{ $user->id }}">Apellido:</label>
                        <input type="text" class="form-control" id="apellido{{ $user->id }}" name="apellido"
                            value="{{ $user->apellido }}">
                    </div>

                    <div class="form-group">
                        <label for="email{{ $user->id }}">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="email{{ $user->id }}" name="email"
                            value="{{ $user->email }}">
                    </div>
                    <div class="form-group">
                        <label for="ci{{ $user->id }}">Carnet:</label>
                        <input type="text" class="form-control" id="ci{{ $user->id }}" name="ci"
                            value="{{ $user->ci }}">
                    </div>
                    <div class="form-group">
                        <label for="telefono{{ $user->id }}">Telefono:</label>
                        <input type="text" class="form-control" id="telefono{{ $user->id }}" name="telefono"
                            value="{{ $user->telefono }}">
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
                                <option value="{{ $rol->id }}" @if ($user->id_rol === $rol->id) selected @endif>
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
                                <option value="{{ $sucursal->id }}" @if ($user->id_sucursal === $sucursal->id) selected @endif>
                                    {{ $sucursal->nombre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
