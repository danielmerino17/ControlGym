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
        Schema::create('prestamo', function (Blueprint $table) {
            $table->id('id_prestamo');
    
            // Relación con cliente
            $table->foreignId('id_cliente')->constrained('cliente', 'id_cliente');

            // Relaciones con usuario (autoriza y devolución opcional)
            $table->unsignedBigInteger('id_usuario_autoriza');
            $table->foreign('id_usuario_autoriza')->references('id_usuario')->on('usuario');

            $table->unsignedBigInteger('id_usuario_devolucion')->nullable();
            $table->foreign('id_usuario_devolucion')->references('id_usuario')->on('usuario');

            $table->dateTime('fecha_hora_salida');
            $table->dateTime('fecha_hora_devolucion')->nullable();
            $table->enum('estado', ['activo', 'devuelto'])->default('activo');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prestamo_');
    }
};
