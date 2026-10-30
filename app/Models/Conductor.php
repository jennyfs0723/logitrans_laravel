<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Conductor extends Model
{
    use HasFactory;

    /**
     * Nombre exacto de la tabla en MySQL.
     */
    protected $table = 'conductors';

    /**
     * Permitir la inserción de todos los datos ya validados por el controlador.
     */
    protected $guarded = [];

    /**
     * Casts de atributos.
     */
    protected function casts(): array
    {
        return [
            'fecha_vencimiento_licencia' => 'date',
            'anios_experiencia'          => 'integer',
        ];
    }

    public function rutas(): HasMany
    {
        return $this->hasMany(RutaDistribucion::class);
    }
}