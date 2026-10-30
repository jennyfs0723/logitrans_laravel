<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable = [
        'codigo_unico',
        'tipo_cliente',
        'nombre_o_razon_social',
        'rut_o_dni',
        'direccion_fiscal',
        'telefono',
        'email',
    ];

    public function envios(): HasMany
    {
        return $this->hasMany(Envio::class, 'cliente_id');
    }
}