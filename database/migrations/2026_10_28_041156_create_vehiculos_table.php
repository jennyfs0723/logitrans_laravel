<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('vehiculos', function (Blueprint $table) {
            $table->id();
            $table->string('registro_unico',20)->unique();
            $table->string('marca',20);
            $table->string('modelo',20);
            $table->year('anio');
            $table->decimal('capacidad_carga',10,2);
            $table->decimal('consumo_promedio_combustible', 10,2);
            $table->string('numero_placa')->unique();
            $table->date('fecha_adquisicion');
            $table->decimal('km_actual', 10,2);
            $table->enum('estado_operativo',['activo','en mantenimiento']);
            $table->enum('tipo_vehiculo',['camion','furgoneta','motocicleta']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehiculos');
    }
};
