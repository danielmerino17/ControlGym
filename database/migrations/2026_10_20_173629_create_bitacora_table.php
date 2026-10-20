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
        Schema::create('bitacoras', function (Blueprint $table) {
    $table->id();
    $table->foreignId('user_id')->nullable()->constrained('usuarios')->onDelete('set null');
    $table->string('accion'); // Ej: INSERT, UPDATE, DELETE
    $table->string('modulo'); // Ej: Clientes, Membresías
    $table->text('detalles')->nullable();
    $table->string('ip_address')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bitacora');
    }
};
