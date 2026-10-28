<?php

namespace App\Models;

use Database\Factories\ConductorFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Fillable([
    'codigo_empleado',
    'nombres',
    'apellidos',
    'documento_identidad',
    'telefono',
    'tipo_licencia',
    'fecha_vencimiento_licencia',
    'anios_experiencia',
    'estado_conductor',
])]
class Conductor extends Model
{
    use HasFactory;

    protected function casts(): array
    {
        return [
            'fecha_vencimiento_licencia' => 'date',
        ];
    }

    public function rutas(): HasMany
    {
        return $this->hasMany(RutaDistribucion::class, 'conductor_id');
    }

    
    public function seguimientos(): HasMany
    {
        return $this->hasMany(SeguimientoEnvio::class, 'conductor_id');
    }
}