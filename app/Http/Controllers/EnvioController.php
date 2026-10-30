<?php

namespace App\Http\Controllers;

use App\Models\Envio;
use App\Models\Cliente;
use App\Models\Conductor;
use Illuminate\Http\Request;

class EnvioController extends Controller
{
    public function index()
    {
        $envios = Envio::with('cliente')->latest('fecha_hora_recepcion')->paginate(10);
        return view('envios.index', compact('envios'));
    }

    public function create()
    {
        $clientes = Cliente::all();
        $conductorDisponible = Conductor::where('estado_conductor', 'disponible')->first();

        return view('envios.create', compact('clientes', 'conductorDisponible'));
    }

    public function store(Request $request)
    {
        $ultimoId = Envio::max('id') ?? 0;
        $numeroGuia = 'GUI-' . str_pad($ultimoId + 1, 6, '0', STR_PAD_LEFT);

        $validated = $request->validate([
            'cliente_id'               => 'required|exists:clientes,id',
            'remitente'                => 'required|string|max:20',
            'destinatario'             => 'required|string|max:20',
            'direccion_origen'         => 'required|string|max:50',
            'direccion_entrega'        => 'required|string|max:50',
            'tipo_servicio'            => 'required|in:normal,express,mismo dia',
            'descripcion_contenido'    => 'required|string|max:200',
            'peso'                     => 'required|numeric|min:0.1',
            'dimensiones'              => 'required|string|max:255',
            'valor_declarado'          => 'required|numeric|min:0',
            'costo'                    => 'required|numeric|min:0',
            'forma_pago'               => 'required|in:contra entrega,transferencia,efectivo,tarjeta',
            'instrucciones_especiales' => 'nullable|string|max:200',
        ]);

        $validated['numero_guia']          = $numeroGuia;
        $validated['fecha_hora_recepcion'] = now();
        $validated['estado_actual']        = 'recibido';
        $validated['ruta_distribucion_id'] = $request->ruta_distribucion_id ?? 1;

        // Asignación automática de conductor si hay disponible
        $conductor = Conductor::where('estado_conductor', 'disponible')->first();
        if ($conductor) {
            $conductor->update(['estado_conductor' => 'en ruta']);
        }

        Envio::create($validated);

        return redirect()->route('envios.index')
            ->with('success', "Guía $numeroGuia registrada exitosamente.");
    }

    public function show(Envio $envio)
    {
        $envio->load('cliente');
        return view('envios.show', compact('envio'));
    }

    public function edit(Envio $envio)
    {
        $clientes = Cliente::all();
        return view('envios.edit', compact('envio', 'clientes'));
    }

    public function update(Request $request, Envio $envio)
    {
        $validated = $request->validate([
            'cliente_id'               => 'required|exists:clientes,id',
            'remitente'                => 'required|string|max:20',
            'destinatario'             => 'required|string|max:20',
            'direccion_origen'         => 'required|string|max:50',
            'direccion_entrega'        => 'required|string|max:50',
            'tipo_servicio'            => 'required|in:normal,express,mismo dia',
            'descripcion_contenido'    => 'required|string|max:200',
            'peso'                     => 'required|numeric|min:0.1',
            'dimensiones'              => 'required|string|max:255',
            'valor_declarado'          => 'required|numeric|min:0',
            'costo'                    => 'required|numeric|min:0',
            'forma_pago'               => 'required|in:contra entrega,transferencia,efectivo,tarjeta',
            'estado_actual'            => 'required|in:recibido,en transito,entregado',
            'instrucciones_especiales' => 'nullable|string|max:200',
        ]);

        $envio->update($validated);

        return redirect()->route('envios.index')
            ->with('success', 'Envío actualizado exitosamente.');
    }

    public function destroy(Envio $envio)
{
    try {
        // Intentamos eliminar el envío
        $envio->delete();

        return redirect()->route('envios.index')
            ->with('success', '¡Envío eliminado exitosamente!');
            
    } catch (\Illuminate\Database\QueryException $e) {
        // Si hay un error de llave foránea (integridad referencial)
        if ($e->getCode() == "23000") {
            return redirect()->route('envios.index')
                ->with('warning', '¡No puedes eliminar este envío porque se encuentra asociado a una ruta o seguimiento!');
        }
        
        // Si es otro tipo de error de base de datos
        return redirect()->route('envios.index')
            ->with('error', 'Ocurrió un error al intentar eliminar el envío.');
    }
}
}