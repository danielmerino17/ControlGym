<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prestamos', function (Blueprint $table) {
            $table->id();
            // Apunta directo a tu tabla 'cliente' usando 'id_cliente'
            $table->foreignId('id_cliente')->constrained('cliente', 'id_cliente')->cascadeOnDelete();
            $table->string('articulo');
            $table->dateTime('fecha_prestamo');
            $table->dateTime('fecha_devolucion')->nullable();
            $table->string('estado')->default('prestado');
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prestamos');
    }
};