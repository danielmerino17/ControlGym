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
        Schema::create('movimiento_inventario', function (Blueprint $table) {
            $table->id('id_movimiento');
            $table->foreignId('id_material')->constrained('material', 'id_material');
            
            // Suponiendo que la tabla de usuarios se llama 'usuario'
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_usuario')->references('id_usuario')->on('usuario');

            $table->enum('tipo', ['alta', 'baja', 'ajuste']);
            $table->integer('cantidad');
            $table->integer('cantidad_anterior');
            $table->integer('cantidad_nueva');
            $table->string('motivo', 255);
            $table->dateTime('fecha_hora');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movimiento_inventario');
    }
};
