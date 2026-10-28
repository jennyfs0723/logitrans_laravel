<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $validated = $request->validate([
            'codigo_empleado'            => 'required|string|max:80|unique:conductors,codigo_empleado',
            'nombres'                    => 'required|string|max:80',
            'apellidos'                  => 'required|string|max:80',
            'documento_identidad'        => 'required|string|max:80|unique:conductors,documento_identidad',
            'telefono'                   => 'required|string|max:20',
            'tipo_licencia'              => 'required|string|max:20',
            'fecha_vencimiento_licencia' => 'required|date',
            'anios_experiencia'          => 'required|integer|min:0',
            'estado_conductor'           => 'required|string|max:50',
        ]);

        Conductor::create($validated);

        return redirect()->route('conductores.index')
            ->with('success', 'Conductor registrado exitosamente.');
    }

    public function show(Conductor $conductor)
    {
        $conductor->load(['rutas', 'seguimientos']);
        return view('conductores.show', compact('conductor'));
    }

    
    public function edit(Conductor $conductor)
    {
        return view('conductores.edit', compact('conductor'));
    }

   
    public function update(Request $request, Conductor $conductor)
    {
        $validated = $request->validate([
            'codigo_empleado'            => ['required', 'string', 'max:80', Rule::unique('conductors')->ignore($conductor->id)],
            'nombres'                    => 'required|string|max:80',
            'apellidos'                  => 'required|string|max:80',
            'documento_identidad'        => ['required', 'string', 'max:80', Rule::unique('conductors')->ignore($conductor->id)],
            'telefono'                   => 'required|string|max:20',
            'tipo_licencia'              => 'required|string|max:20',
            'fecha_vencimiento_licencia' => 'required|date',
            'anios_experiencia'          => 'required|integer|min:0',
            'estado_conductor'           => 'required|string|max:50',
        ]);

        $conductor->update($validated);

        return redirect()->route('conductores.index')
            ->with('success', 'Conductor actualizado exitosamente.');
    }

  
    public function destroy(Conductor $conductor)
    {
        if ($conductor->rutas()->exists()) {
            return back()->with('error', 'No se puede eliminar el conductor porque tiene rutas asignadas.');
        }

        $conductor->delete();

        return redirect()->route('conductores.index')
            ->with('success', 'Conductor eliminado correctamente.');
    }
}