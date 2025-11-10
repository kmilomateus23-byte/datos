@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold">Panel de Reservas (Administrador)</h2>
        <span class="badge bg-primary fs-6">Bienvenido: {{ $user->name }}</span>
    </div>

    <a href="{{ route('dashboard') }}" class="btn btn-secondary mb-3">
        ← Volver al Panel
    </a>

    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-bottom">
            <h5 class="mb-0">Listado de Reservas</h5>
        </div>

        <div class="card-body p-0">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th>Usuario</th>
                        <th>Fecha</th>
                        <th>Hora</th>
                        <th>Estado</th>
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservas as $reserva)
                        <tr>
                            <td>{{ $reserva->user->name }}</td>
                            <td>{{ $reserva->fecha }}</td>
                            <td>{{ $reserva->hora }}</td>

                            <td>
                                <span class="badge 
                                    @if($reserva->estado == 'aprobada') bg-success
                                    @elseif($reserva->estado == 'rechazada') bg-danger
                                    @else bg-warning text-dark
                                    @endif
                                ">
                                    {{ ucfirst($reserva->estado) }}
                                </span>
                            </td>

                            <td class="text-center d-flex justify-content-center gap-2">

                                @if($reserva->estado !== 'aprobada')
                                <form action="{{ route('reservas.updateEstado', [$reserva->id, 'aprobada']) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-success btn-sm">Aprobar</button>
                                </form>
                                @endif

                                @if($reserva->estado !== 'rechazada')
                                <form action="{{ route('reservas.updateEstado', [$reserva->id, 'rechazada']) }}" method="POST">
                                    @csrf @method('PATCH')
                                    <button class="btn btn-warning btn-sm text-dark">Rechazar</button>
                                </form>
                                @endif

                                <form action="{{ route('reservas.destroy', $reserva) }}" method="POST"
                                      onsubmit="return confirm('¿Eliminar esta reserva?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Eliminar</button>
                                </form>

                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">
                                No hay reservas registradas.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
