<!-- Modal para ver el horario del usuario -->
<div class="modal fade" id="verHorarioModal" tabindex="-1" role="dialog" aria-labelledby="verHorarioModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="verHorarioModalLabel">Horario del Usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>Día</th>
                            <th>Hora de Entrada</th>
                            <th>Hora de Salida</th>
                        </tr>
                    </thead>
                    <tbody id="horarioBody">
                        @if ($user->user_horario)
                            @foreach ($user->user_horario as $horario)
                                <tr>
                                    <td>{{ $horario->dia_laboral }}</td>
                                    <td>{{ $horario->horario->hora_entrada }}</td>
                                    <td>{{ $horario->horario->hora_salida }}</td>
                                </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="3">El usuario no tiene un horario asignado.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
