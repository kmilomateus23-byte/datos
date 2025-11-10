@extends('layouts.app')

@section('content')
<div class="bg-white p-6 rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Nueva Reserva</h2>

    <form action="{{ route('reservas.store') }}" method="POST">
        @csrf
        <div class="mb-4">
            <label for="fecha" class="block text-gray-700">Fecha:</label>
            <input type="date" name="fecha" id="fecha" class="border rounded w-full p-2" required>
        </div>

        <div class="mb-4">
            <label for="hora" class="block text-gray-700">Hora:</label>
            <input type="time" name="hora" id="hora" class="border rounded w-full p-2" required>
        </div>

        <div class="mb-4">
            <label for="descripcion" class="block text-gray-700">Descripción:</label>
            <input type="text" name="descripcion" id="descripcion" class="border rounded w-full p-2" required>
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            Guardar
        </button>
    </form>
</div>
@endsection
