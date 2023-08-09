<link rel="stylesheet" href="{{ asset('css/documento/documento.css') }}">
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header" style="padding-left: 30%;">Subir Documento</div>
                <br>
                <div class="card-body">
                    <form action="{{ route('registrarDocumento') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="descripcion">Descripción</label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="tipo_documento">Tipo de Documento</label>
                            <input type="text" name="tipo_documento" id="tipo_documento" class="form-control" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="archivo">Archivo</label>
                            <input type="file" name="archivo" id="archivo" class="form-control-file" required>
                        </div>
                        <br>
                        <div class="form-group">
                            <label for="id_user">Usuario</label>
                            <select name="id_user" id="id_user" class="form-control" required>
                                <option value="">Seleccionar Usuario</option>
                                @if (auth()->user()->rol->tipo_rol === 'Gerente')
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                @else
                                    <option value="{{ auth()->user()->id }}">{{ auth()->user()->name }}</option>
                                @endif
                            </select>
                        </div>
                        <br>
                        <button type="submit" class="btn btn-primary" style="width: 100%; height: 5%;">Crear Documento</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
