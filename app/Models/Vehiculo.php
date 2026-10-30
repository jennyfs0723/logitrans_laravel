<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Vehiculo extends Model
{
    use HasFactory;

    protected $fillable = [
        'registro_unico',
        'marca',
        'modelo',
        'anio',
        'capacidad_carga',
        'consumo_promedio_combustible',
        'numero_placa',
        'fecha_adquisicion',
        'km_actual',
        'estado_operativo',
        'tipo_vehiculo',
    ];

    protected function casts(): array
    {
        return [
            'fecha_adquisicion' => 'date',
            'capacidad_carga' => 'decimal:2',
            'consumo_promedio_combustible' => 'decimal:2',
            'km_actual' => 'decimal:2',
        ];
    }

    public function rutas(): HasMany
    {
        return $this->hasMany(RutaDistribucion::class, 'vehiculo_id');
    }
}