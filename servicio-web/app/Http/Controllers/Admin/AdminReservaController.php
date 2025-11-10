<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Reserva;

class AdminReservaController extends Controller
{
    public function index()
    {
        $reservas = Reserva::all();
        return view('admin.reservas.index', compact('reservas'));
    }

    public function edit(Reserva $reserva)
    {
        return view('admin.reservas.edit', compact('reserva'));
    }

    public function update(Request $request, Reserva $reserva)
    {
        $request->validate([
            'fecha' => 'required|date',
            'hora' => 'required',
            'descripcion' => 'required|string'
        ]);
        $reserva->update($request->only(['fecha', 'hora', 'descripcion']));
        return redirect()->route('admin.reservas.index')->with('success', 'Reserva modificada');
    }

    public function updateEstado(Request $request, Reserva $reserva)
    {
        $reserva->estado = $request->input('estado');
        $reserva->save();
        return redirect()->route('admin.reservas.index')->with('success', 'Estado actualizado');
    }

    public function destroy(Reserva $reserva)
    {
        $reserva->delete();
        return redirect()->route('admin.reservas.index')->with('success', 'Reserva eliminada');
    }
}
