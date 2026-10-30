<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    public function index()
    {
        $clientes = Cliente::latest()->paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        // 1. Generar automáticamente el código consecutivo (ej. C-001, C-002)
        $ultimoId = Cliente::max('id') ?? 0;
        $codigoAutogenerado = 'C-' . str_pad($ultimoId + 1, 3, '0', STR_PAD_LEFT);

        // 2. Validar campos (teléfono solo números)
        $validated = $request->validate([
            'tipo_cliente'          => 'required|in:individual,empresarial',
            'nombre_o_razon_social' => 'required|string|max:255',
            'rut_o_dni'             => 'required|string|max:20|unique:clientes,rut_o_dni',
            'telefono'              => 'required|numeric|digits_between:7,15',
            'email'                 => 'required|email|max:255|unique:clientes,email',
            'direccion_fiscal'      => 'required|string|max:255',
        ], [
            'telefono.numeric'        => 'El teléfono debe contener únicamente números.',
            'telefono.digits_between' => 'El teléfono debe tener entre 7 y 15 dígitos.',
        ]);

        // 3. Asignar el código generado
        $validated['codigo_unico'] = $codigoAutogenerado;

        Cliente::create($validated);

        return redirect()->route('clientes.index')
            ->with('success', "Cliente registrado con el código $codigoAutogenerado exitosamente.");
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'tipo_cliente'          => 'required|in:individual,empresarial',
            'nombre_o_razon_social' => 'required|string|max:255',
            'rut_o_dni'             => 'required|string|max:20|unique:clientes,rut_o_dni,' . $cliente->id,
            'telefono'              => 'required|numeric|digits_between:7,15',
            'email'                 => 'required|email|max:255|unique:clientes,email,' . $cliente->id,
            'direccion_fiscal'      => 'required|string|max:255',
        ], [
            'telefono.numeric'        => 'El teléfono debe contener únicamente números.',
            'telefono.digits_between' => 'El teléfono debe tener entre 7 y 15 dígitos.',
        ]);

        $cliente->update($validated);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado exitosamente.');
    }

    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }
}