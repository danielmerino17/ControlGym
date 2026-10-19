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
        Schema::create('tipo_membresia', function (Blueprint $table) {
            $table->id('id_tipo');
            $table->string('nombre', 50)->unique();
            $table->integer('duracion_dias');
            $table->decimal('costo', 10, 2);
            $table->string('descripcion', 255)->nullable();
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipo_membresia');
    }
};
