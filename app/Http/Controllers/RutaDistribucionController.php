<?php

namespace App\Http\Controllers;

use App\Models\RutaDistribucion;
use App\Models\Vehiculo;
use App\Models\Conductor;
use Illuminate\Http\Request;

class RutaDistribucionController extends Controller
{
    public function index()
    {
        $rutas = RutaDistribucion::with(['vehiculo', 'conductor'])->latest()->paginate(10);
        return view('rutas.index', compact('rutas'));
    }

    public function create()
    {
        $vehiculos = Vehiculo::all();
        $conductores = Conductor::all();
        return view('rutas.create', compact('vehiculos', 'conductores'));
    }

    public function store(Request $request)
    {
        // Generación automática del código en secuencia RD-000001
        $ultimoId = RutaDistribucion::max('id') ?? 0;
        $codigo = 'RD-' . str_pad($ultimoId + 1, 6, '0', STR_PAD_LEFT);

        $validated = $request->validate([
            'nombre_ruta'               => 'required|string|max:255',
            'zona_geografica'          => 'required|string|max:255',
            'puntos_entrega_habituales' => 'required|string|max:255',
            'distancia_total_km'        => 'required|numeric|min:0',
            'tiempo_estimado'           => 'required|integer|min:0',
            'vehiculo_id'               => 'required|exists:vehiculos,id',
            'conductor_id'              => 'required|exists:conductors,id',
        ]);

        $validated['codigo'] = $codigo;

        RutaDistribucion::create($validated);

        return redirect()->route('rutas.index')
            ->with('success', "Ruta de distribución $codigo registrada exitosamente.");
    }

    public function show(RutaDistribucion $ruta)
    {
        $ruta->load(['vehiculo', 'conductor', 'envios']);
        return view('rutas.show', compact('ruta'));
    }

    public function edit(RutaDistribucion $ruta)
    {
        $vehiculos = Vehiculo::all();
        $conductores = Conductor::all();
        return view('rutas.edit', compact('ruta', 'vehiculos', 'conductores'));
    }

    public function update(Request $request, RutaDistribucion $ruta)
    {
        $validated = $request->validate([
            'nombre_ruta'               => 'required|string|max:255',
            'zona_geografica'          => 'required|string|max:255',
            'puntos_entrega_habituales' => 'required|string|max:255',
            'distancia_total_km'        => 'required|numeric|min:0',
            'tiempo_estimado'           => 'required|integer|min:0',
            'vehiculo_id'               => 'required|exists:vehiculos,id',
            'conductor_id'              => 'required|exists:conductors,id',
        ]);

        $ruta->update($validated);

        return redirect()->route('rutas.index')
            ->with('success', 'Ruta de distribución actualizada correctamente.');
    }

    public function destroy($id) // O RutaDistribucion $ruta (dependiendo de cómo recibas el parámetro)
    {
        // Buscar la ruta si usas inyección de modelos o por id
        $ruta = RutaDistribucion::findOrFail($id);

        // Verificar si la ruta tiene envíos asociados
        if ($ruta->envios()->count() > 0) {
            return redirect()->route('rutas.index')
                ->with('error', 'No puedes eliminar esta ruta porque tiene envíos activos asociados.');
        }

        try {
            $ruta->delete();
            return redirect()->route('rutas.index')
                ->with('success', 'Ruta de distribución eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('rutas.index')
                ->with('error', 'Ocurrió un error al intentar eliminar la ruta.');
        }
    }
}