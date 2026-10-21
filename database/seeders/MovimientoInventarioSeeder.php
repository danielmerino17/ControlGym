<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MovimientoInventarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('movimiento_inventario')->insert([
            [
                'id_material' => 1,
                'id_usuario' => 1, // El usuario admin que creamos antes
                'tipo' => 'alta',
                'cantidad' => 20,
                'cantidad_anterior' => 0,
                'cantidad_nueva' => 20,
                'motivo' => 'Compra inicial de inventario para pesas',
                'fecha_hora' => Carbon::now()->subDays(5),
            ],
        ]);
    }
}