<!-- Modal para crear un nuevo horario -->
<div class="modal fade" id="crearHorarioModal" tabindex="-1" role="dialog" aria-labelledby="crearHorarioModalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="crearHorarioModalLabel">Crear Horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="crearHorarioForm" action="{{ route('horario.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="turno">Turno</label>
                        <input type="text" class="form-control" id="turno" name="turno" required>
                    </div>
                    <div class="form-group">
                        <label for="hora_entrada">Hora de Entrada</label>
                        <input type="time" class="form-control" id="hora_entrada" name="hora_entrada" required>
                    </div>
                    <div class="form-group">
                        <label for="hora_salida">Hora de Salida</label>
                        <input type="time" class="form-control" id="hora_salida" name="hora_salida" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Crear Horario</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
