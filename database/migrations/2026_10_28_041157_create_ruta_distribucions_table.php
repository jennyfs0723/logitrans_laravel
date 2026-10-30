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
        Schema::create('ruta_distribucions', function (Blueprint $table) {
            $table->id();
            $table->string('codigo',20)->unique();
            $table->string('nombre_ruta');
            $table->string('zona_geografica');
            $table->string('puntos_entrega_habituales');
            $table->decimal('distancia_total_km',10,2);
            $table->integer('tiempo_estimado');
            $table->foreignId('vehiculo_id')->constrained()->restrictOnDelete();
            $table->foreignId('conductor_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ruta_distribucions');
    }
};
