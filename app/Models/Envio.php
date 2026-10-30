<?php

namespace App\Models;

use Database\Factories\EnvioFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Envio extends Model
{
    use HasFactory;

    protected $table = 'envios';

    // Desprotegemos todos los campos para evitar que Laravel descarte masivamente
    // columnas como direccion_entrega, valor_declarado o id_cliente
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'fecha_hora_recepcion' => 'datetime',
            'peso'                 => 'decimal:2',
            'valor_declarado'      => 'decimal:2',
            'costo'                => 'decimal:2',
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