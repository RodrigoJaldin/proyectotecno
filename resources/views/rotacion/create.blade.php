<!-- Modal Crear Rotación -->
<div class="modal fade" id="crearRotacionModal" tabindex="-1" role="dialog" aria-labelledby="crearRotacionModalLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="crearRotacionModalLabel">Registrar Rotación</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('rotacion.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <label for="fecha">Fecha:</label>
                        <input type="date" class="form-control" id="fecha" name="fecha" required>
                    </div>
                    <div class="form-group">
                        <label for="usuario_solicitante">Usuario Solicitante:</label>
                        <select class="form-control" id="usuario_solicitante" name="usuario_solicitante" required>
                            <!-- Mostrar la lista de usuarios solicitantes -->
                            @foreach ($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="usuario_reemplazante">Usuario Reemplazante:</label>
                        <select class="form-control" id="usuario_reemplazante" name="usuario_reemplazante" required>
                            <!-- Mostrar la lista de usuarios reemplazantes, excluyendo al usuario solicitante -->
                            @foreach ($users as $user)
                                @if ($user->id !== old('usuario_solicitante_id'))
                                    <!-- O puedes usar el valor que recibiste en el controlador -->
                                    <option value="{{ $user->id }}">{{ $user->name }}</option>
                                @endif
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

@section('js')
    <script>
        // Función para obtener los horarios del usuario solicitante mediante una consulta AJAX
        function fetchHorariosSolicitante(usuarioSolicitanteId) {
            $.ajax({
                url: `/getHorarios/${usuarioSolicitanteId}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const selectHorarioSolicitante = $('#id_horario_solicitante');
                    selectHorarioSolicitante.empty();
                    data.forEach(horario => {
                        selectHorarioSolicitante.append($('<option>', {
                            value: horario.id,
                            text: horario.turno
                        }));
                    });
                }
            });
        }

        // Función para obtener los horarios del usuario reemplazante mediante una consulta AJAX
        function fetchHorariosReemplazante(usuarioReemplazanteId) {
            $.ajax({
                url: `/getHorarios/${usuarioReemplazanteId}`,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    const selectHorarioReemplazante = $('#id_horario_reemplazante');
                    selectHorarioReemplazante.empty();
                    data.forEach(horario => {
                        selectHorarioReemplazante.append($('<option>', {
                            value: horario.id,
                            text: horario.turno
                        }));
                    });
                }
            });
        }

        // Asociar las funciones de actualización a los eventos de cambio de selección
        $('#usuario_solicitante').on('change', function() {
            fetchHorariosSolicitante($(this).val());
        });

        $('#usuario_reemplazante').on('change', function() {
            fetchHorariosReemplazante($(this).val());
        });
    </script>
@stop
