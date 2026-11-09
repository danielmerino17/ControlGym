<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodoPagoSeeder extends Seeder
{
    public function run(): void
    {
        // Se registran los métodos de pago. 
        $metodos = [
            ['nombre' => 'Efectivo', 'activo' => true],
            ['nombre' => 'Tarjeta de débito', 'activo' => true],
            ['nombre' => 'Tarjeta de crédito', 'activo' => true],
            ['nombre' => 'Transferencia', 'activo' => true],
            ['nombre' => 'Bitcoin', 'activo' => false],
        ];

        // Se insertan o actualizan los métodos de pago en la base de datos.
        foreach ($metodos as $metodo) {
            DB::table('metodo_pago')->updateOrInsert(
                ['nombre' => $metodo['nombre']], // Condición de búsqueda
                $metodo // Valores a insertar o actualizar
            );
        }
    }
}