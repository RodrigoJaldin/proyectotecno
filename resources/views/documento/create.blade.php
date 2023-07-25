<div class="modal fade" id="crearDocumentoModal" tabindex="-1" role="dialog" aria-labelledby="crearDocumentoModalLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearDocumentoModalLabel">Crear Nuevo Documento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('documento.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="tipo_documento">Tipo de Documento</label>
                        <input type="text" name="tipo_documento" id="tipo_documento" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="archivo">Archivo</label>
                        <input type="file" name="archivo" id="archivo" class="form-control-file" required>
                    </div>
                    <div class="form-group">
                        <label for="id_user">Usuario</label>
                        <select name="id_user" id="id_user" class="form-control" required>
                            <option value="">Seleccionar Usuario</option>
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Documento</button>
                </form>
            </div>
        </div>
    </div>
</div>
