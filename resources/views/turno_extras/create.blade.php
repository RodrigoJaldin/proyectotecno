<!-- Modal Crear Rol -->
<div class="modal fade" id="crearTurnoExtraModal" tabindex="-1" role="dialog" aria-labelledby="crearTurnoExtraModalLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="crearTurnoExtraModalLabel">Crear Nuevo Rol</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('turnosExtra.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="cantidad_horas">Cantidad de Horas</label>
                    <input type="number" name="cantidad_horas" id="cantidad_horas" class="form-control">
                </div>
                <div class="form-group">
                    <label for="id_user">Usuario</label>
                    <select name="id_user" id="id_user" class="form-control">
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Guardar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            </form>
        </div>
    </div>
</div>

{{-- {{  }}
 --}}
