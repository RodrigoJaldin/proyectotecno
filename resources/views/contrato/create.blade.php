<!-- Modal Crear Rol -->
<div class="modal fade" id="crearContratoModal" tabindex="-1" role="dialog" aria-labelledby="crearContratoModalLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="crearContratoModalLabel">Crear Nuevo Rol</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('contratos.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="horas_laborales">Horas Laborales</label>
                    <input type="number" class="form-control" name="horas_laborales" id="horas_laborales" required>
                </div>
                <div class="form-group">
                    <label for="fecha_inicio">Fecha Inicio</label>
                    <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" required>
                </div>
                <div class="form-group">
                    <label for="fecha_fin">Fecha Fin</label>
                    <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" required>
                </div>
                <div class="form-group">
                    <label for="sueldo">Sueldo</label>
                    <input type="number" class="form-control" name="sueldo" id="sueldo" required>
                </div>
                <div class="form-group">
                    <label for="id_user">Usuario</label>
                    <select name="id_user" id="id_user" class="form-control" required>
                        <option value="">Seleccione un usuario</option>
                        @foreach ($usuarios as $usuario)
                            <option value="{{ $usuario->id }}">{{ $usuario->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Crear</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </div>
            </form>
        </div>
    </div>
</div>
