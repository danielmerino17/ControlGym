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
        Schema::create('detalle_prestamo', function (Blueprint $table) {
            $table->foreignId('id_prestamo')->constrained('prestamo', 'id_prestamo')->onDelete('cascade');
            $table->foreignId('id_material')->constrained('material', 'id_material');
            $table->integer('cantidad');

            // Definición de llave primaria compuesta
            $table->primary(['id_prestamo', 'id_material']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detalle_prestamo');
    }
};
