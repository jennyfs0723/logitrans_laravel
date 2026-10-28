<?php

namespace App\Models;

use Database\Factories\ClienteFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


#[Fillable([
    'codigo_unico',
    'tipo_cliente',
    'nombre_o_razon_social',
    'rut_o_dni',
    'direccion_fiscal',
    'telefono',
    'email',
])]
class Cliente extends Model
{
    
    use HasFactory;

    public function envios(): HasMany
    {
        return $this->hasMany(Envio::class, 'cliente_id');
    }
}