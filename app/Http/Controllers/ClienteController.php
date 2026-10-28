<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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
        $validated = $request->validate([
            'codigo_unico'          => 'required|string|max:80|unique:clientes,codigo_unico',
            'tipo_cliente'          => 'required|in:individual,empresarial',
            'nombre_o_razon_social' => 'required|string|max:80',
            'rut_o_dni'             => 'required|string|max:80|unique:clientes,rut_o_dni',
            'direccion_fiscal'      => 'required|string|max:80',
            'telefono'              => 'required|string|max:20',
            'email'                 => 'required|email|max:80|unique:clientes,email',
        ]);

        Cliente::create($validated);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente registrado exitosamente.');
    }

    
    public function show(Cliente $cliente)
    {
        $cliente->load('envios');
        return view('clientes.show', compact('cliente'));
    }

   
    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

   
    public function update(Request $request, Cliente $cliente)
    {
        $validated = $request->validate([
            'codigo_unico'          => ['required', 'string', 'max:80', Rule::unique('clientes')->ignore($cliente->id)],
            'tipo_cliente'          => 'required|in:individual,empresarial',
            'nombre_o_razon_social' => 'required|string|max:80',
            'rut_o_dni'             => ['required', 'string', 'max:80', Rule::unique('clientes')->ignore($cliente->id)],
            'direccion_fiscal'      => 'required|string|max:80',
            'telefono'              => 'required|string|max:20',
            'email'                 => ['required', 'email', 'max:80', Rule::unique('clientes')->ignore($cliente->id)],
        ]);

        $cliente->update($validated);

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente actualizado exitosamente.');
    }


    public function destroy(Cliente $cliente)
    {
        // Verifica si tiene envíos asociados antes de borrar
        if ($cliente->envios()->exists()) {
            return back()->with('error', 'No se puede eliminar el cliente porque tiene envíos registrados.');
        }

        $cliente->delete();

        return redirect()->route('clientes.index')
            ->with('success', 'Cliente eliminado correctamente.');
    }
}