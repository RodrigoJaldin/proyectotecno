@extends('layouts.app')

@section('content')
    <h1>Editar Contrato</h1>

    <form action="{{ route('contratos.update', $contrato) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="horas_laborales">Horas Laborales</label>
            <input type="number" class="form-control" name="horas_laborales" id="horas_laborales" value="{{ $contrato->horas_laborales }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_inicio">Fecha Inicio</label>
            <input type="date" class="form-control" name="fecha_inicio" id="fecha_inicio" value="{{ $contrato->fecha_inicio }}" required>
        </div>
        <div class="form-group">
            <label for="fecha_fin">Fecha Fin</label>
            <input type="date" class="form-control" name="fecha_fin" id="fecha_fin" value="{{ $contrato->fecha_fin }}" required>
        </div>
        <div class="form-group">
            <label for="sueldo">Sueldo</label>
            <input type="number" class="form-control" name="sueldo" id="sueldo" value="{{ $contrato->sueldo }}" required>
        </div>
        <div class="form-group">
            <label for="id_user">Usuario</label>
            <select name="id_user" id="id_user" class="form-control" required>
                @foreach ($usuarios as $usuario)
                    <option value="{{ $usuario->id }}" {{ $usuario->id === $contrato->user->id ? 'selected' : '' }}>{{ $usuario->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('contrato.index') }}" class="btn btn-secondary">Cancelar</a>
    </form>
@endsection
