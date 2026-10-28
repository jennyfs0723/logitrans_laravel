<?php

namespace App\Models;

use Database\Factories\EnvioFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


#[Fillable([
    'numero_guia',
    'fecha_hora_recepcion',
    'remitente',
    'destinatario',
    'direccion_origen',
    'direccion_entrega',
    'tipo_servicio',
    'descripcion_contenido',
    'peso',
    'dimensiones',
    'costo',
    'forma_pago',
    'estado_actual',
    'instrucciones_especiales',
    'cliente_id',
    'ruta_distribucion_id',
])]
class Envio extends Model
{
    
    use HasFactory;

    protected function casts(): array
    {
        return [
            'fecha_hora_recepcion' => 'datetime',
            'peso' => 'decimal:2',
            'costo' => 'decimal:2',
        ];
    }

  
    public function cliente(): BelongsTo
    {
        return $this->belongsTo(Cliente::class, 'cliente_id');
    }

   
    public function ruta(): BelongsTo
    {
        return $this->belongsTo(RutaDistribucion::class, 'ruta_distribucion_id');
    }

  
    public function seguimientos(): HasMany
    {
        return $this->hasMany(SeguimientoEnvio::class, 'envio_id')->orderBy('fecha_hora', 'desc');
    }
}