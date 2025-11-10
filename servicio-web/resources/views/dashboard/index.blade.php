@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Bienvenido al Dashboard</h2>
    <p>Hola {{ Auth::user()->name }}, has iniciado sesión correctamente.</p>

    <div class="mt-4">
        <a href="{{ route('reservas.index') }}" class="btn btn-primary">Ir a Reservas</a>

        {{-- 🔥 Este botón solo lo verá el admin --}}
        @if(Auth::user()->role === 'admin')
            <a href="{{ route('reservas.admin') }}" class="btn btn-danger ms-2">Panel de Reservas (Admin)</a>
        @endif
    </div>
</div>
@endsection
