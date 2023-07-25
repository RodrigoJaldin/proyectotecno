<div class="modal fade" id="verHorarioModal" tabindex="-1" role="dialog" aria-labelledby="verHorarioModalLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verHorarioModalLabel">Horario del Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" id="horarioUsuarioBody">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Día</th>
                            <th>Hora de Entrada</th>
                            <th>Hora de Salida</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($user->user_horarios as $horario)
                            <tr>
                                <td>{{ $horario->dia_laboral }}</td>
                                <td>{{ $horario->horario->hora_entrada }}</td>
                                <td>{{ $horario->horario->hora_salida }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3">El usuario no tiene un horario asignado.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>


</div>

