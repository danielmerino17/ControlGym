<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class PrestamoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('prestamo')->insert([
            [
                'id_cliente' => 1, // Carlos Gómez
                'id_usuario_autoriza' => 1, // Admin
                'id_usuario_devolucion' => null,
                'fecha_hora_salida' => Carbon::now()->subDays(1),
                'fecha_hora_devolucion' => null,
                'estado' => 'activo',
                'observaciones' => 'Préstamo de mat para clase grupal',
            ],
        ]);
    }
}