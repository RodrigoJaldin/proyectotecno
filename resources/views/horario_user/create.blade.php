<!-- Modal para asignar horario a un usuario -->
<div class="modal fade" id="asignarHorarioModal" tabindex="-1" role="dialog" aria-labelledby="asignarHorarioModalLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="asignarHorarioModalLabel">Asignar Horario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="asignarHorarioForm" action="{{ route('asignarHorario') }}" method="POST">
                    @csrf
                    <input type="hidden" id="userId" name="userId" value="{{ $user->id }}">


                    <div class="form-group">
                        <label for="horario_id">Seleccionar Horario</label>
                        <select class="form-control" id="horario_id" name="horario_id">
                            @foreach($horarios as $horario)
                                <option value="{{ $horario->id }}">{{ $horario->turno }} - {{ $horario->hora_entrada }} a {{ $horario->hora_salida }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="dia_laboral">Seleccionar Día Laboral</label>
                        <select class="form-control" id="dia_laboral" name="dia_laboral">
                            <option value="Lunes">Lunes</option>
                            <option value="Martes">Martes</option>
                            <option value="Miércoles">Miércoles</option>
                            <option value="Jueves">Jueves</option>
                            <option value="Viernes">Viernes</option>
                            <option value="Sábado">Sábado</option>
                            <option value="Domingo">Domingo</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Asignar</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
