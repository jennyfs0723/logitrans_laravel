<?php

namespace App\Http\Controllers;

use App\Models\Vehiculo;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class VehiculoController extends Controller
{
    
    public function index()
    {
        $vehiculos = Vehiculo::latest()->paginate(10);
        return view('vehiculos.index', compact('vehiculos'));
    }

  
    public function create()
    {
        return view('vehiculos.create');
    }

    
    public function store(Request $request)
    {
        $validated =$request->validate([
            'registro_unico'               => 'required|string|max:80|unique:vehiculos,registro_unico',
            'marca'                        => 'required|string|max:80',
            'modelo'                       => 'required|string|max:80',
            'anio'                         => 'required|integer|digits:4|min:1900|max:' . (date('Y') + 1),
            'capacidad_carga'              => 'required|numeric|min:0',
            'consumo_promedio_combustible' => 'required|numeric|min:0',
            'numero_placa'                 => 'required|string|max:20|unique:vehiculos,numero_placa',
            'fecha_adquisicion'            => 'required|date',
            'km_actual'                    => 'required|numeric|min:0',
            'estado_operativo'             => 'required|string|max:50',
            'tipo_vehiculo'                => 'required|string|max:50',
        ]);

        Vehiculo::create($validated);

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo registrado exitosamente.');
    }

    public function show(Vehiculo $vehiculo)
    {
        $vehiculo->load('rutas');
        return view('vehiculos.show', compact('vehiculo'));
    }

    /**
     * Muestra el formulario de edición de un vehículo.
     */
    public function edit(Vehiculo $vehiculo)
    {
        return view('vehiculos.edit', compact('vehiculo'));
    }

    public function update(Request $request, Vehiculo$vehiculo)
    {
        $validated =$request->validate([
            'registro_unico'               => ['required', 'string', 'max:80', Rule::unique('vehiculos')->ignore($vehiculo->id)],
            'marca'                        => 'required|string|max:80',
            'modelo'                       => 'required|string|max:80',
            'anio'                         => 'required|integer|digits:4|min:1900|max:' . (date('Y') + 1),
            'capacidad_carga'              => 'required|numeric|min:0',
            'consumo_promedio_combustible' => 'required|numeric|min:0',
            'numero_placa'                 => ['required', 'string', 'max:20', Rule::unique('vehiculos')->ignore($vehiculo->id)],
            'fecha_adquisicion'            => 'required|date',
            'km_actual'                    => 'required|numeric|min:0',
            'estado_operativo'             => 'required|string|max:50',
            'tipo_vehiculo'                => 'required|string|max:50',
        ]);

        $vehiculo->update($validated);

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo actualizado exitosamente.');
    }

 
    public function destroy(Vehiculo $vehiculo)
    {
        if ($vehiculo->rutas()->exists()) {
            return back()->with('error', 'No se puede eliminar el vehículo porque tiene rutas asignadas.');
        }

        $vehiculo->delete();

        return redirect()->route('vehiculos.index')
            ->with('success', 'Vehículo eliminado correctamente.');
    }
}