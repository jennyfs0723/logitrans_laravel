<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Envio;
use App\Models\RutaDistribucion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EnvioController extends Controller
{
   
    public function index()
    {
        $envios = Envio::with(['cliente', 'ruta'])
            ->latest()
            ->paginate(10);

        return view('envios.index', compact('envios'));
    }

  
    public function create()
    {
        $clientes = Cliente::select('id', 'tipo_cliente', 'nombre_o_razon_social', 'telefono', 'email')->get();
        $rutas = RutaDistribucion::select('id', 'codigo', 'nombre_ruta')->get();

        return view('envios.create', compact('clientes', 'rutas'));
    }

    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'numero_guia'              => 'required|string|max:80|unique:envios,numero_guia',
            'fecha_hora_recepcion'     => 'required|date',
            'remitente'                => 'required|string|max:80',
            'destinatario'             => 'required|string|max:80',
            'direccion_origen'         => 'required|string|max:80',
            'direccion_entrega'        => 'required|string|max:80',
            'tipo_servicio'            => 'required|string|max:50',
            'descripcion_contenido'    => 'nullable|string',
            'peso'                     => 'required|numeric|min:0',
            'dimensiones'              => 'required|string|max:80',
            'costo'                    => 'required|numeric|min:0',
            'forma_pago'               => 'required|string|max:50',
            'estado_actual'            => 'required|string|max:50',
            'instrucciones_especiales' => 'nullable|string',
            'cliente_id'               => 'required|exists:clientes,id',
            'ruta_distribucion_id'     => 'required|exists:ruta_distribucions,id',
        ]);

        Envio::create($validated);

        return redirect()->route('envios.index')
            ->with('success', 'Envío registrado exitosamente.');
    }

   
    public function show(Envio $envio)
    {
        $envio->load(['cliente', 'ruta', 'seguimientos.conductor']);

        return view('envios.show', compact('envio'));
    }

  
    public function edit(Envio $envio)
    {
        $clientes = Cliente::select('id', 'tipo_cliente', 'nombre_o_razon_social')->get();
        $rutas = RutaDistribucion::select('id', 'codigo', 'nombre_ruta')->get();

        return view('envios.edit', compact('envio', 'clientes', 'rutas'));
    }

  
    public function update(Request $request, Envio $envio)
    {
        $validated = $request->validate([
            'numero_guia'              => ['required', 'string', 'max:80', Rule::unique('envios')->ignore($envio->id)],
            'fecha_hora_recepcion'     => 'required|date',
            'remitente'                => 'required|string|max:80',
            'destinatario'             => 'required|string|max:80',
            'direccion_origen'         => 'required|string|max:80',
            'direccion_entrega'        => 'required|string|max:80',
            'tipo_servicio'            => 'required|string|max:50',
            'descripcion_contenido'    => 'nullable|string',
            'peso'                     => 'required|numeric|min:0',
            'dimensiones'              => 'required|string|max:80',
            'costo'                    => 'required|numeric|min:0',
            'forma_pago'               => 'required|string|max:50',
            'estado_actual'            => 'required|string|max:50',
            'instrucciones_especiales' => 'nullable|string',
            'cliente_id'               => 'required|exists:clientes,id',
            'ruta_distribucion_id'     => 'required|exists:ruta_distribucions,id',
        ]);

        $envio->update($validated);

        return redirect()->route('envios.index')
            ->with('success', 'Envío actualizado exitosamente.');
    }

   
    public function destroy(Envio $envio)
    {
        if ($envio->seguimientos()->exists()) {
            return back()->with('error', 'No se puede eliminar el envío porque ya registra historial de seguimiento.');
        }

        $envio->delete();

        return redirect()->route('envios.index')
            ->with('success', 'Envío eliminado correctamente.');
    }
}