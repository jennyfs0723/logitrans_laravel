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
        Schema::create('seguimiento_envios', function (Blueprint $table) {
            $table->id();
            $table->dateTime('fecha_hora');
            $table->string('ubicacion',100);
            $table->enum('actividad_realizada',['recibido','en transito','almacen','entregado']);
            $table->string('observaciones',200);
            $table->foreignId('envio_id')->constrained()->noActionOnDelete();
            $table->foreignId('conductor_id')->constrained()->noActionOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seguimiento_envios');
    }
};
