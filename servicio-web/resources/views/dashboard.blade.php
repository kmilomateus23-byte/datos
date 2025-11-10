<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(auth()->user()->is_admin)
                {{-- DASHBOARD ADMINISTRADOR --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-bold mb-4">Panel de Administración</h3>
                        <p class="mb-4">Bienvenido, <strong>{{ auth()->user()->name }}</strong> (Administrador)</p>
                    </div>
                </div>

                {{-- Tarjetas de estadísticas --}}
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                    <div class="bg-blue-500 text-white rounded-lg shadow-lg p-6">
                        <h4 class="text-lg font-semibold mb-2">Total Reservas</h4>
                        <p class="text-3xl font-bold">{{ $totalReservas ?? 0 }}</p>
                    </div>
                    <div class="bg-green-500 text-white rounded-lg shadow-lg p-6">
                        <h4 class="text-lg font-semibold mb-2">Confirmadas</h4>
                        <p class="text-3xl font-bold">{{ $reservasConfirmadas ?? 0 }}</p>
                    </div>
                    <div class="bg-yellow-500 text-white rounded-lg shadow-lg p-6">
                        <h4 class="text-lg font-semibold mb-2">Pendientes</h4>
                        <p class="text-3xl font-bold">{{ $reservasPendientes ?? 0 }}</p>
                    </div>
                </div>

                {{-- Acciones rápidas --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Acciones Rápidas</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('admin.reservas.index') }}" 
                               class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition">
                                📋 Gestionar Todas las Reservas
                            </a>
                            <a href="{{ route('reservas.create') }}" 
                               class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition">
                                ➕ Crear Nueva Reserva
                            </a>
                        </div>
                    </div>
                </div>

            @else
                {{-- DASHBOARD USUARIO NORMAL --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mb-6">
                    <div class="p-6 text-gray-900 dark:text-gray-100">
                        <h3 class="text-2xl font-bold mb-4">¡Bienvenido, {{ auth()->user()->name }}!</h3>
                        <p class="text-gray-600 dark:text-gray-400">Gestiona tus reservas desde aquí.</p>
                    </div>
                </div>

                {{-- Mis estadísticas --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div class="bg-purple-500 text-white rounded-lg shadow-lg p-6">
                        <h4 class="text-lg font-semibold mb-2">Mis Reservas</h4>
                        <p class="text-3xl font-bold">{{ $misReservas ?? 0 }}</p>
                    </div>
                    <div class="bg-teal-500 text-white rounded-lg shadow-lg p-6">
                        <h4 class="text-lg font-semibold mb-2">Próximas Reservas</h4>
                        <p class="text-3xl font-bold">{{ $proximasReservas ?? 0 }}</p>
                    </div>
                </div>

                {{-- Acciones de usuario --}}
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6">
                        <h3 class="text-xl font-bold text-gray-900 dark:text-gray-100 mb-4">Mis Acciones</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <a href="{{ route('reservas.index') }}" 
                               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition">
                                📋 Ver Mis Reservas
                            </a>
                            <a href="{{ route('reservas.create') }}" 
                               class="bg-green-600 hover:bg-green-700 text-white font-semibold py-3 px-6 rounded-lg text-center transition">
                                ➕ Nueva Reserva
                            </a>
                        </div>
                    </div>
                </div>
            @endif

        </div>
    </div>
</x-app-layout>