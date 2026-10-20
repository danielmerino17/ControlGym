<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PagoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('pago')->insert([
            [
                'id_membresia' => 1,
                'id_metodo_pago' => 1, // Efectivo
                'id_usuario_registra' => 1,
                'id_usuario_autoriza' => null,
                'monto' => 500.00,
                'descuento' => 0.00,
                'fecha_hora' => Carbon::now()->subDays(10),
                'folio_comprobante' => 'PAGO-001',
            ],
            [
                'id_membresia' => 2,
                'id_metodo_pago' => 2, // Tarjeta
                'id_usuario_registra' => 1,
                'id_usuario_autoriza' => 1,
                'monto' => 4500.00,
                'descuento' => 500.00, // Descuento promocional
                'fecha_hora' => Carbon::now()->subDays(5),
                'folio_comprobante' => 'PAGO-002',
            ],
        ]);
    }
}