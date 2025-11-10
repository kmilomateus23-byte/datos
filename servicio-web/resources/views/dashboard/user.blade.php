@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h2 class="fw-bold mb-3">Bienvenido, {{ $user->name }}</h2>

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-body">
            <p class="mb-0">Aquí puedes gestionar tus reservas.</p>
        </div>
    </div>

    <a href="{{ route('reservas.create') }}" class="btn btn-primary mb-3">
        + Crear Reserva
    </a>

    <a href="{{ route('reservas.index') }}" class="btn btn-outline-secondary mb-3">
        Ver Mis Reservas
    </a>
</div>
@endsection
