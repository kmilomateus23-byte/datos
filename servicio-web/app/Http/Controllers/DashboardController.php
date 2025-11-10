<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\Reserva;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        // Si el usuario es admin → ver todas las reservas
        if ($user->role === 'admin') {
            $reservas = Reserva::with('user')->get(); // Todas las reservas con nombre de usuario
            return view('dashboard.admin', compact('user', 'reservas'));
        }

        // Si es usuario normal → ver solo sus reservas
        $reservas = Reserva::where('user_id', $user->id)->get();
        return view('dashboard.user', compact('user', 'reservas'));
    }
}
