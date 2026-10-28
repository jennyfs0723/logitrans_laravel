<?php

namespace App\Models;

use Database\Factories\RutaDistribucionFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


#[Fillable([
    'codigo',
    'nombre_ruta',
    'zona_geografica',
    'puntos_entrega_habituales',
    'distancia_total_km',
    'tiempo_estimado',
    'vehiculo_id',
    'conductor_id',
])]
class RutaDistribucion extends Model
{
    
    use HasFactory;

    protected function casts(): array
    {
        return [
            'distancia_total_km' => 'decimal:2',
        ];
    }

  
    public function vehiculo(): BelongsTo
    {
        return $this->belongsTo(Vehiculo::class, 'vehiculo_id');
    }

    public function conductor(): BelongsTo
    {
        return $this->belongsTo(Conductor::class, 'conductor_id');
    }

    /**
     * Una ruta TRANSPORTA MUCHOS envíos.
     * SQL: select * from envios where ruta_distribucion_id = ?
     */
    public function envios(): HasMany
    {
        return $this->hasMany(Envio::class, 'ruta_distribucion_id');
    }
}

