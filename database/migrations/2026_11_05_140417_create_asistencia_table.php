<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistencia', function (Blueprint $table) {
            $table->id('id_asistencia');
            $table->foreignId('id_cliente')->constrained('cliente', 'id_cliente')->onDelete('cascade');
            $table->dateTime('fecha_hora');
            $table->enum('resultado', ['permitido', 'denegado']);
            $table->string('motivo_denegacion', 255)->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencia');
    }
};