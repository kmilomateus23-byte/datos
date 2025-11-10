@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="mb-3 fw-bold">Mis Reservas (Admin)</h2>

    {{-- BOTÓN PARA CREAR --}}
    <a href="{{ route('reservas.create') }}" class="btn btn-primary mb-3">
        + Crear Nueva Reserva
    </a>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">Listado</h5>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Descripción</th>
                        <th>Estado</th>
                        <th class="text-center">Acción</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservas as $reserva)
                    <tr>
                        <td>{{ $reserva->fecha }}</td>
                        <td>{{ $reserva->hora }}</td>
                        <td>{{ $reserva->descripcion }}</td>
                        <td>
                            <span class="badge
                                @if($reserva->estado == 'aprobada') bg-success
                                @elseif($reserva->estado == 'rechazada') bg-danger
                                @elseif($reserva->estado == 'cancelada') bg-warning text-dark
                                @else bg-secondary
                                @endif">
                                {{ ucfirst($reserva->estado) }}
                            </span>
                        </td>
                        <td class="text-center">

                            <!-- Aprobar -->
                            @if($reserva->estado !== 'aprobada')
                                <form action="{{ route('admin.reservas.updateEstado', $reserva) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="estado" value="aprobada">
                                    <button class="btn btn-success btn-sm mb-1" type="submit">Aprobar</button>
                                </form>
                            @endif

                            <!-- Cancelar -->
                            @if($reserva->estado !== 'cancelada')
                                <form action="{{ route('admin.reservas.updateEstado', $reserva) }}" method="POST" style="display:inline-block;">
                                    @csrf @method('PATCH')
                                    <input type="hidden" name="estado" value="cancelada">
                                    <button class="btn btn-warning btn-sm mb-1" type="submit">Cancelar</button>
                                </form>
                            @endif

                            <!-- Editar -->
                            <a href="{{ route('admin.reservas.edit', $reserva) }}" class="btn btn-primary btn-sm mb-1">Editar</a>

                            <!-- Eliminar -->
                            <form action="{{ route('admin.reservas.destroy', $reserva) }}" method="POST"
                                  style="display:inline-block" onsubmit="return confirm('¿Eliminar esta reserva?');">
                                @csrf @method('DELETE')
                                <button class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-4 text-muted">
                            No tienes reservas aún.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
