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
        Schema::create('usuario', function (Blueprint $table) {
            $table->id('id_usuario'); // Llave primaria personalizada
            $table->unsignedBigInteger('id_rol'); // Llave foránea hacia roles
            $table->string('nombre_completo', 150);
            $table->string('usuario', 50)->unique();
            $table->string('correo', 150)->unique();
            $table->string('contrasena_hash', 255);
            $table->string('token_recuperacion', 255)->nullable();
            $table->dateTime('token_expira')->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuario');
    }
};
