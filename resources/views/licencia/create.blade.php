<!-- Modal para crear una nueva licencia -->
<div class="modal fade" id="crearLicenciaModal" tabindex="-1" role="dialog" aria-labelledby="crearLicenciaModalLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearHorarioModalLabel">Crear Licencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="crearLicenciaForm" action="{{ route('licencia.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="fecha_inicio">Fecha de Inicio</label>
                        <input type="date" name="fecha_inicio" id="fecha_inicio" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="fecha_fin">Fecha Fin</label>
                        <input type="date" name="fecha_fin" id="fecha_fin" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo_licencia">Tipo de Licencia</label>
                        <input type="text" name="tipo_licencia" id="tipo_licencia" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="estado">Estado</label>
                        <select name="estado" id="estado" class="form-control" required>
                            <option value="pendiente">Pendiente</option>
                        </select>
                    </div>
                    @if (Auth::user()->rol->tipo_rol == 'Gerente')
                        <div class="form-group">
                            <label for="id_user">Seleccionar Usuario</label>
                            <select name="id_user" id="id_user" class="form-control" required>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif

                    <button type="submit" class="btn btn-primary">Crear Licencia</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
