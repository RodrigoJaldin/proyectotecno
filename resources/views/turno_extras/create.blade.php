<!-- resources/views/turno_extra/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Crear Turno Extra</h1>

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
    </form>
@endsection
