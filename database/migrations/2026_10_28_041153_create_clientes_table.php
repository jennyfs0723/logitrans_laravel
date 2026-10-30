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
    Schema::create('clientes', function (Blueprint $table) {
        $table->id();
        $table->string('codigo_unico',80)->unique();
        $table->enum('tipo_cliente', ['individual', 'empresarial']);
        $table->string('nombre_o_razon_social',80);
        $table->string('rut_o_dni',80)->unique();
        $table->string('direccion_fiscal',80);
        $table->string('telefono',20);
        $table->string('email',80)->unique();
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clientes');
    }
};
