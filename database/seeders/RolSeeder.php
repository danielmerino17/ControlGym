<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rol')->insert([
            ['id_rol' => 1, 'nombre' => 'Administrador', 'descripcion' => 'Control total del sistema'],
            ['id_rol' => 2, 'nombre' => 'Recepcionista', 'descripcion' => 'Atención al cliente y registro de pagos'],
        ]);
    }
}