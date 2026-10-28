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
        Schema::create('conductors', function (Blueprint $table) {
            $table->id();
            $table->string('codigo_empleado')->unique();
            $table->string('nombres',50);
            $table->string('apellidos',50);
            $table->string('documento_identidad',20)->unique();
            $table->string('telefono',20)->unique();
            $table->enum('tipo_licencia',['C2','A1','A2']);
            $table->date('fecha_vencimiento_licencia');
            $table->integer('anios_experiencia');
            $table->enum('estado_conductor',['disponible','en ruta','descanso']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('conductors');
    }
};
