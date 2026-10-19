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
        Schema::create('cliente', function (Blueprint $table) {
            $table->id('id_cliente');
            $table->string('nombre', 80);
            $table->string('apellido_paterno', 80);
            $table->string('apellido_materno', 80)->nullable();
            $table->string('telefono', 15)->unique();
            $table->string('correo', 150)->unique()->nullable();
            $table->string('documento_identidad', 30)->unique()->nullable();
            $table->date('fecha_registro');
            $table->string('contacto_emergencia', 150)->nullable();
            $table->string('telefono_emergencia', 15)->nullable();
            $table->text('observaciones')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cliente');
    }
};
