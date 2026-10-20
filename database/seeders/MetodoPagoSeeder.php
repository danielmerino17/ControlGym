<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodoPagoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('metodo_pago')->insert([
            ['nombre' => 'Efectivo', 'activo' => true],
            ['nombre' => 'Tarjeta de Crédito/Débito', 'activo' => true],
            ['nombre' => 'Transferencia Bancaria', 'activo' => true],
        ]);
    }
}