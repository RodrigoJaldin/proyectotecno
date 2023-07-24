<!-- Modal Editar Rol -->
<div class="modal fade" id="editarSucursalModal{{ $sucursal->id }}" tabindex="-1" role="dialog"
    aria-labelledby="editarSucursalModal{{ $sucursal->id }}" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="editarSucursalModal{{ $sucursal->id }}">Editar Sucursal</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="editarSucursalForm{{ $sucursal->id }}" action="{{ route('sucursal.update', $sucursal->id) }}"
                method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="nombre{{ $sucursal->id }}">Nombre:</label>
                        <input type="text" class="form-control" id="nombre{{ $sucursal->id }}"
                            name="nombre" value="{{ $sucursal->nombre }}">
                    </div>
                    <div class="form-group">
                        <label for="direccion{{ $sucursal->id }}">Direccion:</label>
                        <input type="text" class="form-control" id="direccion{{ $sucursal->id }}"
                            name="direccion" value="{{ $sucursal->direccion }}">
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
