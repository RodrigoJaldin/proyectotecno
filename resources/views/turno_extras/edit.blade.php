<!-- resources/views/turno_extra/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Editar Turno Extra</h1>

    <form action="{{ route('turnosExtra.update', $turnoExtra->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="cantidad_horas">Cantidad de Horas</label>
            <input type="number" name="cantidad_horas" id="cantidad_horas" class="form-control" value="{{ $turnoExtra->cantidad_horas }}">
        </div>
        <div class="form-group">
            <label for="id_user">Usuario</label>
            <select name="id_user" id="id_user" class="form-control">
                @foreach ($users as $user)
                    <option value="{{ $user->id }}" {{ $user->id == $turnoExtra->user_id ? 'selected' : '' }}>{{ $user->name }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
