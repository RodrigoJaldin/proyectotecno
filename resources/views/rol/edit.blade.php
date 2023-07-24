<!-- Modal Editar Rol -->
<div class="modal fade" id="editarRolModal{{ $rol->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editarRolModal{{ $rol->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="editarRolModal{{ $rol->id }}">Editar Rol</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editarRolForm{{ $rol->id }}" action="{{ route('rol.update', $rol->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="tipo_rol{{ $rol->id }}">Tipo de Rol:</label>
                        <input type="text" class="form-control" id="tipo_rol{{ $rol->id }}"
                            name="tipo_rol" value="{{ $rol->tipo_rol }}">
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
