<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SeguimientoEnvio extends Model
{
    use HasFactory;

    protected $table = 'seguimiento_envios';
    protected $guarded = [];

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