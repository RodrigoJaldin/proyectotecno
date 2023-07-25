<!-- resources/views/documento/create.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Crear Nuevo Documento</h1>
    <form action="{{ route('documento.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="tipo_documento">Tipo de Documento</label>
            <input type="text" name="tipo_documento" id="tipo_documento" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="archivo">Archivo</label>
            <input type="file" name="archivo" id="archivo" class="form-control-file" required>
        </div>
        <div class="form-group">
            <label for="id_user">ID de Usuario</label>
            <input type="text" name="id_user" id="id_user" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Crear Documento</button>
    </form>
@endsection
