@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2>Editar Reserva</h2>
    <form action="{{ route('admin.reservas.update', $reserva) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="fecha" class="form-label">Fecha</label>
            <input type="date" name="fecha" id="fecha" class="form-control" value="{{ $reserva->fecha }}" required>
        </div>
        <div class="mb-3">
            <label for="hora" class="form-label">Hora</label>
            <input type="time" name="hora" id="hora" class="form-control" value="{{ $reserva->hora }}" required>
        </div>
        <div class="mb-3">
            <label for="descripcion" class="form-label">Descripción</label>
            <input type="text" name="descripcion" id="descripcion" class="form-control" value="{{ $reserva->descripcion }}" required>
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
        <a href="{{ route('admin.reservas.index') }}" class="btn btn-secondary">Volver</a>
    </form>
</div>
@endsection
