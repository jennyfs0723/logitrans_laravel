<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    public function index()
    {
        $conductores = Conductor::latest()->paginate(10);
        return view('conductores.index', compact('conductores'));
    }

    public function create()
    {
        return view('conductores.create');
    }

    public function store(Request $request)
    {
        $ultimoId = Conductor::max('id') ?? 0;
        $codigoAutogenerado = 'CD-' . str_pad($ultimoId + 1, 2, '0', STR_PAD_LEFT);

        $validated = $request->validate([
            'documento_identidad'         => 'required|string|max:20|unique:conductors,documento_identidad',
            'nombres'                     => 'required|string|max:255',
            'apellidos'                   => 'required|string|max:255',
            'telefono'                    => 'required|numeric|digits_between:7,15',
            'tipo_licencia'               => 'required|string|max:10',
            'fecha_vencimiento_licencia' => 'required|date',
            'anios_experiencia'          => 'required|integer|min:0',
            'estado_conductor'            => 'required|in:disponible,en ruta,descanso',
        ], [
            'telefono.numeric'        => 'El teléfono debe contener únicamente números.',
            'telefono.digits_between' => 'El teléfono debe tener entre 7 y 15 dígitos.',
            'estado_conductor.in'     => 'Seleccione un estado válido (disponible, en ruta, descanso).',
        ]);

        $validated['codigo_empleado'] = $codigoAutogenerado;

        Conductor::create($validated);

        return redirect()->route('conductores.index')
            ->with('success', "Conductor registrado con el código $codigoAutogenerado exitosamente.");
    }

    public function show(Conductor $conductor)
    {
        return view('conductores.show', compact('conductor'));
    }

    public function edit(Conductor $conductor)
    {
        return view('conductores.edit', compact('conductor'));
    }

    public function update(Request $request, Conductor $conductor)
    {
        $validated = $request->validate([
            'documento_identidad'         => 'required|string|max:20|unique:conductors,documento_identidad,' . $conductor->id,
            'nombres'                     => 'required|string|max:255',
            'apellidos'                   => 'required|string|max:255',
            'telefono'                    => 'required|numeric|digits_between:7,15',
            'tipo_licencia'               => 'required|string|max:10',
            'fecha_vencimiento_licencia' => 'required|date',
            'anios_experiencia'          => 'required|integer|min:0',
            'estado_conductor'            => 'required|in:disponible,en ruta,descanso',
        ], [
            'telefono.numeric'        => 'El teléfono debe contener únicamente números.',
            'telefono.digits_between' => 'El teléfono debe tener entre 7 y 15 dígitos.',
            'estado_conductor.in'     => 'Seleccione un estado válido (disponible, en ruta, descanso).',
        ]);

        $conductor->update($validated);

        return redirect()->route('conductores.index')
            ->with('success', 'Conductor actualizado exitosamente.');
    }

    public function destroy(Conductor $conductor)
    {
        $conductor->delete();
        return redirect()->route('conductores.index')
            ->with('success', 'Conductor eliminado correctamente.');
    }
}