<!-- Modal para registrar la hora de llegada -->
<div class="modal fade" id="modalRegistrarAsistencia" tabindex="-1" role="dialog" aria-labelledby="modalRegistrarAsistenciaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistrarAsistenciaLabel">Registrar Asistencia</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Deseas registrar la hora de llegada?</p>
                <p><strong>Usuario:</strong> <span ></span>{{ auth()->user()->name }}</p>
                <p><strong>Fecha:</strong> <span id="fechaActual"></span></p>
                <p><strong>Hora de llegada:</strong> <span id="horaLlegada"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnConfirmarLlegada" class="btn btn-primary">Registrar Llegada</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal para registrar la hora de salida -->
<div class="modal fade" id="modalRegistrarSalida" tabindex="-1" role="dialog" aria-labelledby="modalRegistrarSalidaLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalRegistrarSalidaLabel">Registrar Salida</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>¿Deseas registrar la hora de salida?</p>
                <p><strong>Usuario:</strong> <span ></span>{{ auth()->user()->name }}</p>

                <p><strong>Fecha:</strong> <span id="fechaActualSalida"></span></p>
                <p><strong>Hora de salida:</strong> <span id="horaSalida"></span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" id="btnConfirmarSalida" class="btn btn-primary">Registrar Salida</button>
            </div>
        </div>
    </div>
</div>
