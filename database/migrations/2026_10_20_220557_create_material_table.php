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
        Schema::create('material', function (Blueprint $table) {
            $table->id('id_material');
            $table->foreignId('id_categoria')->constrained('categoria_material', 'id_categoria');
            $table->string('nombre', 100);
            $table->string('descripcion', 255)->nullable();
            $table->integer('cantidad_total')->default(0);
            $table->enum('estado', ['bueno', 'regular', 'mantenimiento'])->default('bueno');
            $table->boolean('activo')->default(true);
            $table->timestamps();
        });

        // Se agrega la restricción CHECK para que cantidad_total sea mayor o igual a 0 (compatible con SQLite y MySQL)
        DB::statement('ALTER TABLE material ADD CONSTRAINT chk_cantidad_total CHECK (cantidad_total >= 0);');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('material');
    }
};
