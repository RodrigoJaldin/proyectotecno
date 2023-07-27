<!-- Modal Crear Usuario -->
<div class="modal fade" id="crearUserModal" tabindex="-1" role="dialog" aria-labelledby="crearUserModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="crearUserModalLabel">Crear Nuevo Usuario</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="crearUserForm" action="{{ route('user.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="codigo_empleado">Codigo:</label>
                        <input type="text" class="form-control" id="codigo_empleado" name="codigo_empleado" value="BM_000" required>
                    </div>
                    <div class="form-group">
                        <label for="name">Nombre:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="form-group">
                        <label for="apellido">Apellido:</label>
                        <input type="text" class="form-control" id="apellido" name="apellido" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Correo Electrónico:</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Contraseña:</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="ci">Carnet:</label>
                        <input type="text" class="form-control" id="ci" name="ci" required>
                    </div>
                    <div class="form-group">
                        <label for="telefono">Telefono:</label>
                        <input type="text" class="form-control" id="telefono" name="telefono" required>
                    </div>
                    <div class="mb-3">
                        <label for="foto_user" class="form-label">{{ __('Selecciona una Imgen') }}</label>

                        <input type="file" id="foto_user" class="form-control" name="foto_user" accept="image/*">
                        <br>
                        @error('foto_user')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="id_rol">Rol:</label>
                        <select class="form-control" id="id_rol" name="id_rol" required>
                            <option value="">Seleccione un rol</option>
                            @foreach ($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->tipo_rol }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="id_sucursal">Sucursal:</label>
                        <select class="form-control" id="id_sucursal" name="id_sucursal" required>
                            <option value="">Seleccione la Sucursal</option>
                            @foreach ($sucursales as $sucursal)
                                <option value="{{ $sucursal->id }}">{{ $sucursal->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
