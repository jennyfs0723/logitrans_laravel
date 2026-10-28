<?php

namespace App\Models;

use Database\Factories\SeguimientoEnvioFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


#[Fillable([
    'fecha_hora',
    'ubicacion',
    'actividad_realizada',
    'observaciones',
    'envio_id',
    'conductor_id',
])]
class SeguimientoEnvio extends Model
{
    
    use HasFactory;

    protected function casts(): array
    {
        return [
            'fecha_hora' => 'datetime',
        ];
    }

    
    public function envio(): BelongsTo
    {
        return $this->belongsTo(Envio::class, 'envio_id');
    }

 
    public function conductor(): BelongsTo
    {
        return $this->belongsTo(Conductor::class, 'conductor_id');
    }
}