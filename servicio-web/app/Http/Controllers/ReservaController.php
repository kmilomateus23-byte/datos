<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserva;
use Illuminate\Support\Facades\Auth;

class ReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::where('user_id', Auth::id())->get();
        return view('reservas.index', compact('reservas'));
    }

    public function create()
    {
        return view('reservas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'descripcion' => 'required|string',
        ]);

        Reserva::create([
            'user_id' => Auth::id(),
            'fecha' => $request->fecha,
            'hora' => $request->hora,
            'descripcion' => $request->descripcion,
            'estado' => 'pendiente', // Estado inicial por defecto
        ]);

        return redirect()->route('reservas.index')->with('success', 'Reserva creada correctamente.');
    }

    public function destroy(Reserva $reserva)
    {
        // Solo permite eliminar si es el dueño o el admin
        if ($reserva->user_id !== Auth::id() && Auth::user()->role !== 'admin') {
            abort(403);
        }

        $reserva->delete();
        return redirect()->back()->with('success', 'Reserva eliminada.');
    }

    // Panel del Administrador
    public function adminIndex()
    {
        $reservas = Reserva::with('user')->get(); // Trae reservas + datos del usuario
        $user = Auth::user(); // Usuario logueado

        return view('reservas.admin', compact('reservas', 'user'));
    }

    // Actualizar estado (aprobada / rechazada)
    public function updateEstado($id, $estado)
    {
        $reserva = Reserva::findOrFail($id);
        $reserva->estado = $estado;
        $reserva->save();

        return redirect()->back()->with('success', 'Estado actualizado correctamente.');
    }
}
