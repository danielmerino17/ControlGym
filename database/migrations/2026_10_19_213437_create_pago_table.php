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
        Schema::create('pago', function (Blueprint $table) {
            $table->id('id_pago');
            
            // Relaciones
            $table->foreignId('id_membresia')->constrained('membresia', 'id_membresia')->unique();
            $table->foreignId('id_metodo_pago')->constrained('metodo_pago', 'id_metodo_pago');
            
            // Suponiendo que la tabla de usuarios del sistema se llama 'usuario' o 'users' (ajusta según corresponda)
            $table->unsignedBigInteger('id_usuario_registra');
            $table->foreign('id_usuario_registra')->references('id_usuario')->on('usuario');

            $table->unsignedBigInteger('id_usuario_autoriza')->nullable();
            $table->foreign('id_usuario_autoriza')->references('id_usuario')->on('usuario');

            $table->decimal('monto', 10, 2);
            $table->decimal('descuento', 10, 2)->default(0.00);
            $table->dateTime('fecha_hora');
            $table->string('folio_comprobante', 50)->unique();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pago');
    }
};
