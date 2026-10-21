<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DetallePrestamoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('detalle_prestamo')->insert([
            [
                'id_prestamo' => 1,
                'id_material' => 2, // Mat de Yoga
                'cantidad' => 1,
            ],
        ]);
    }
}