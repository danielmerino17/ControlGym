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
        Schema::create('membresia', function (Blueprint $table) {
            $table->id('id_membresia');
            
            // Llaves foráneas
            $table->foreignId('id_cliente')->constrained('cliente', 'id_cliente')->onDelete('cascade');
            $table->foreignId('id_tipo')->constrained('tipo_membresia', 'id_tipo');
            
            // Llave foránea opcional (autorreferencia para renovación)
            $table->unsignedBigInteger('id_membresia_anterior')->nullable();
            $table->foreign('id_membresia_anterior')->references('id_membresia')->on('membresia')->nullOnDelete();

            $table->date('fecha_inicio');
            $table->date('fecha_fin'); // fecha_fin (inclusiva)
            $table->enum('estado', ['pendiente', 'activa', 'cancelada'])->default('activa');
            $table->string('motivo_cancelacion', 255)->nullable();
            $table->dateTime('fecha_cancelacion')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('membresia');
    }
};
