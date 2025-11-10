@extends('layouts.app')

@section('content')
<div class="container py-4">

    <div class="mb-4">
        <h1 class="fw-bold display-6">Panel de Administración</h1>
        <p class="text-muted">Puedes gestionar todas las reservas de los usuarios.</p>
    </div>

    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-primary shadow-sm">
                <div class="card-body text-primary">
                    <h5 class="card-title mb-2">Total Reservas</h5>
                    <p class="h3">{{ $reservas->count() }}</p>
                </div>
            </div>
        </div>
        {{-- Agrega más tarjetas aquí si tienes estadísticas, como "Aprobadas", "Pendientes", etc. --}}
    </div>

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3 class="mb-0">Listado de Reservas</h3>
        <a href="{{ route('reservas.create') }}" class="btn btn-success">
            + Crear Nueva Reserva
        </a>
    </div>

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <table class="table table-striped align-middle mb-0">
                <thead>
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
                                    @if($reserva->estado === 'aprobada') bg-success
                                    @elseif($reserva->estado === 'rechazada') bg-danger
                                    @else bg-warning text-dark
                                    @endif">
                                    {{ ucfirst($reserva->estado) }}
                                </span>
                            </td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('admin.reservas.destroy', $reserva) }}" style="display:inline;" onsubmit="return confirm('¿Eliminar esta reserva?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-danger btn-sm">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted py-5">
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
