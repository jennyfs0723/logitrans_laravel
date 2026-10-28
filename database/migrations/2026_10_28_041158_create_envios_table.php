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
        Schema::create('envios', function (Blueprint $table) {
            $table->id();
            $table->string('numero_guia', 20)->unique();
            $table->dateTime('fecha_hora_recepcion');
            $table->string('remitente',20);
            $table->string('destinatario',20);
            $table->string('direccion_origen',50);
            $table->string('direccion_entrega',50);
            $table->enum('tipo_servicio',['normal','express','mismo dia']);
            $table->string('descripcion_contenido',200);
            $table->decimal('peso',10,2);
            $table->string('dimensiones');
            $table->decimal('costo',total:10,places:2);
            $table->enum('forma_pago',['contra entrega','transferencia', 'efectivo', 'tarjeta']);
            $table->enum('estado_actual',['en transito','recibido','entregado']);
            $table->string('instrucciones_especiales', 200)->nullable();
            $table->foreignID('cliente_id')->constrained()->restrictOnDelete();
            $table->foreignId('ruta_distribucion_id')->constrained()->restrictOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('envios');
    }
};
