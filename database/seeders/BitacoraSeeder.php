<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class BitacoraSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('bitacora')->insert([
            [
                'id_bitacora' => 1,
                'id_usuario' => 1, // Admin
                'fecha_hora' => Carbon::now()->subDays(2),
                'accion' => 'LOGIN',
                'modulo' => 'Autenticación',
                'id_registro' => 1,
                'detalle' => 'El usuario administrador inició sesión en el sistema.',
            ],
            [
                'id_bitacora' => 2,
                'id_usuario' => 1, // Admin
                'fecha_hora' => Carbon::now()->subDays(1),
                'accion' => 'INSERT',
                'modulo' => 'Inventario',
                'id_registro' => 1,
                'detalle' => 'Se agregó un nuevo material al inventario (Mancuerna 10kg).',
            ],
        ]);
    }
}