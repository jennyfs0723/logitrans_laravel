<?php

namespace App\Http\Controllers;

use App\Models\SeguimientoEnvio;
use App\Models\Envio;
use App\Models\Conductor;
use Illuminate\Http\Request;

class SeguimientoEnvioController extends Controller
{
    public function index()
    {
        $seguimientos = SeguimientoEnvio::with(['envio', 'conductor'])
            ->latest('fecha_hora')
            ->paginate(10);

        return view('seguimientos.index', compact('seguimientos'));
    }

    public function create(Request $request)
    {
        $envios = Envio::all();
        $conductores = Conductor::all();
        $envioSeleccionado = $request->get('envio_id');

        return view('seguimientos.create', compact('envios', 'conductores', 'envioSeleccionado'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'envio_id'            => 'required|exists:envios,id',
            'conductor_id'        => 'required|exists:conductors,id',
            'ubicacion'           => 'required|string|max:100',
            'actividad_realizada' => 'required|in:recibido,en transito,almacen,entregado',
            'observaciones'       => 'required|string|max:200',
            'fecha_hora'          => 'nullable|date',
        ]);

        $validated['fecha_hora'] = $request->fecha_hora ?? now();

        $seguimiento = SeguimientoEnvio::create($validated);

        // Opcional: Actualiza automaticamente el estado general del envio si aplica
        if (in_array($request->actividad_realizada, ['recibido', 'en transito', 'entregado'])) {
            $seguimiento->envio->update([
                'estado_actual' => $request->actividad_realizada
            ]);
        }

        return redirect()->route('seguimientos.index')
            ->with('success', 'Registro de seguimiento añadido exitosamente.');
    }

    public function show(SeguimientoEnvio $seguimiento)
    {
        $seguimiento->load(['envio.cliente', 'conductor']);
        return view('seguimientos.show', compact('seguimiento'));
    }

    public function edit(SeguimientoEnvio $seguimiento)
    {
        $envios = Envio::all();
        $conductores = Conductor::all();
        return view('seguimientos.edit', compact('seguimiento', 'envios', 'conductores'));
    }

    public function update(Request $request, SeguimientoEnvio $seguimiento)
    {
        $validated = $request->validate([
            'envio_id'            => 'required|exists:envios,id',
            'conductor_id'        => 'required|exists:conductors,id',
            'ubicacion'           => 'required|string|max:100',
            'actividad_realizada' => 'required|in:recibido,en transito,almacen,entregado',
            'observaciones'       => 'required|string|max:200',
            'fecha_hora'          => 'required|date',
        ]);

        $seguimiento->update($validated);

        return redirect()->route('seguimientos.index')
            ->with('success', 'Novedad de seguimiento actualizada correctamente.');
    }

    public function destroy(SeguimientoEnvio $seguimiento)
    {
        $seguimiento->delete();
        return redirect()->route('seguimientos.index')
            ->with('success', 'Registro de seguimiento eliminado.');
    }
}