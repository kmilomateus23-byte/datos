@extends('layouts.app')

@section('content')
<div class="container py-4">

    <h2 class="fw-bold mb-3">Panel de Administrador</h2>
    <p class="text-muted">Bienvenido, {{ $user->name }} (Administrador)</p>

   <a href="{{ route('admin.reservas.index') }}" class="btn btn-primary mb-3">
    Ver Reservas de Usuarios
</a>


</div>
@endsection
