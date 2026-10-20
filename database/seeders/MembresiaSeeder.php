<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class MembresiaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('membresia')->insert([
            [
                'id_cliente' => 1,
                'id_tipo' => 1, // Mensualidad General
                'id_membresia_anterior' => null,
                'fecha_inicio' => Carbon::now()->subDays(10),
                'fecha_fin' => Carbon::now()->addDays(20),
                'estado' => 'activa',
                'motivo_cancelacion' => null,
                'fecha_cancelacion' => null,
            ],
            [
                'id_cliente' => 2,
                'id_tipo' => 3, // Anualidad VIP
                'id_membresia_anterior' => null,
                'fecha_inicio' => Carbon::now()->subDays(5),
                'fecha_fin' => Carbon::now()->addDays(360),
                'estado' => 'activa',
                'motivo_cancelacion' => null,
                'fecha_cancelacion' => null,
            ],
        ]);
    }
}