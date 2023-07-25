<!-- resources/views/documento/edit.blade.php -->

@extends('layouts.app')

@section('content')
    <h1>Editar Documento</h1>
    <form action="{{ route('documento.update', $documento) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $documento->descripcion }}" required>
        </div>
        <div class="form-group">
            <label for="tipo_documento">Tipo de Documento</label>
            <input type="text" name="tipo_documento" id="tipo_documento" class="form-control" value="{{ $documento->tipo_documento }}" required>
        </div>
        <div class="form-group">
            <label for="archivo">Archivo</label>
            <input type="file" name="archivo" id="archivo" class="form-control-file">
        </div>
        <div class="form-group">
            <label for="id_user">ID de Usuario</label>
            <input type="text" name="id_user" id="id_user" class="form-control" value="{{ $documento->id_user }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar Documento</button>
    </form>
@endsection
