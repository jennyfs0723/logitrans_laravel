<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\Envio;
use App\Models\SeguimientoEnvio;
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

  
    public function create()
    {
        $envios = Envio::select('id', 'numero_guia', 'destinatario')->get();
        $conductores = Conductor::select('id', 'nombres', 'apellidos', 'codigo_empleado')->get();

        return view('seguimientos.create', compact('envios', 'conductores'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'fecha_hora'          => 'required|date',
            'ubicacion'           => 'required|string|max:80',
            'actividad_realizada' => 'required|string|max:80',
            'observaciones'       => 'nullable|string',
            'envio_id'            => 'required|exists:envios,id',
            'conductor_id'        => 'required|exists:conductors,id',
        ]);

        SeguimientoEnvio::create($validated);

        return redirect()->route('seguimientos.index')
            ->with('success', 'Hito de seguimiento registrado exitosamente.');
    }

    
    public function show(SeguimientoEnvio $seguimiento)
    {
        $seguimiento->load(['envio', 'conductor']);

        return view('seguimientos.show', compact('seguimiento'));
    }

    
    public function edit(SeguimientoEnvio $seguimiento)
    {
        $envios = Envio::select('id', 'numero_guia', 'destinatario')->get();
        $conductores = Conductor::select('id', 'nombres', 'apellidos', 'codigo_empleado')->get();

        return view('seguimientos.edit', compact('seguimiento', 'envios', 'conductores'));
    }

   
    public function update(Request $request, SeguimientoEnvio $seguimiento)
    {
        $validated = $request->validate([
            'fecha_hora'          => 'required|date',
            'ubicacion'           => 'required|string|max:80',
            'actividad_realizada' => 'required|string|max:80',
            'observaciones'       => 'nullable|string',
            'envio_id'            => 'required|exists:envios,id',
            'conductor_id'        => 'required|exists:conductors,id',
        ]);

        $seguimiento->update($validated);

        return redirect()->route('seguimientos.index')
            ->with('success', 'Registro de seguimiento actualizado exitosamente.');
    }

    
    public function destroy(SeguimientoEnvio $seguimiento)
    {
        $seguimiento->delete();

        return redirect()->route('seguimientos.index')
            ->with('success', 'Registro de seguimiento eliminado correctamente.');
    }

    public function rastrear(Request $request)
    {
        $request->validate([
            'numero_guia' => 'required|string',
        ]);

        $envio = Envio::with(['seguimientos.conductor', 'cliente', 'ruta'])
            ->where('numero_guia', $request->input('numero_guia'))
            ->first();

        if (!$envio) {
            return back()->with('error', 'No se encontró ningún envío asociado al número de guía ingresado.');
        }

        return view('welcome', compact('envio'));
    }
}