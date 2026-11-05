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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id('id_usuario');
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password'); 
            $table->rememberToken();
            $table->string('nombre_completo', 150)->nullable();
            $table->string('usuario', 50)->nullable()->unique();
            $table->string('correo', 150)->nullable()->unique();
            $table->string('contrasena_hash', 255)->nullable();
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
