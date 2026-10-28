<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\RutaDistribucion;
use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RutaDistribucionController extends Controller
{
    
    public function index()
    {
        $rutas = RutaDistribucion::with(['vehiculo', 'conductor'])
            ->latest()
            ->paginate(10);

        return view('rutas.index', compact('rutas'));
    }

    
    public function create()
    {
        $vehiculos = Vehiculo::select('id', 'numero_placa', 'marca', 'modelo')->get();
        $conductores = Conductor::select('id', 'nombres', 'apellidos', 'codigo_empleado')->get();

        return view('rutas.create', compact('vehiculos', 'conductores'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'codigo'                    => 'required|string|max:80|unique:ruta_distribucions,codigo',
            'nombre_ruta'               => 'required|string|max:80',
            'zona_geografica'           => 'required|string|max:80',
            'puntos_entrega_habituales' => 'nullable|string',
            'distancia_total_km'        => 'required|numeric|min:0',
            'tiempo_estimado'           => 'required|string|max:80',
            'vehiculo_id'               => 'required|exists:vehiculos,id',
            'conductor_id'              => 'required|exists:conductors,id',
        ]);

        RutaDistribucion::create($validated);

        return redirect()->route('rutas.index')
            ->with('success', 'Ruta de distribución creada exitosamente.');
    }

    public function show(RutaDistribucion $ruta)
    {
        $ruta->load(['vehiculo', 'conductor', 'envios']);

        return view('rutas.show', compact('ruta'));
    }

   
    public function edit(RutaDistribucion $ruta)
    {
        $vehiculos = Vehiculo::select('id', 'numero_placa', 'marca', 'modelo')->get();
        $conductores = Conductor::select('id', 'nombres', 'apellidos', 'codigo_empleado')->get();

        return view('rutas.edit', compact('ruta', 'vehiculos', 'conductores'));
    }

   
    public function update(Request $request, RutaDistribucion $ruta)
    {
        $validated = $request->validate([
            'codigo'                    => ['required', 'string', 'max:80', Rule::unique('ruta_distribucions')->ignore($ruta->id)],
            'nombre_ruta'               => 'required|string|max:80',
            'zona_geografica'           => 'required|string|max:80',
            'puntos_entrega_habituales' => 'nullable|string',
            'distancia_total_km'        => 'required|numeric|min:0',
            'tiempo_estimado'           => 'required|string|max:80',
            'vehiculo_id'               => 'required|exists:vehiculos,id',
            'conductor_id'              => 'required|exists:conductors,id',
        ]);

        $ruta->update($validated);

        return redirect()->route('rutas.index')
            ->with('success', 'Ruta de distribución actualizada exitosamente.');
    }

  
    public function destroy(RutaDistribucion $ruta)
    {
        if ($ruta->envios()->exists()) {
            return back()->with('error', 'No se puede eliminar la ruta porque tiene envíos asociados.');
        }

        $ruta->delete();

        return redirect()->route('rutas.index')
            ->with('success', 'Ruta eliminada correctamente.');
    }
}