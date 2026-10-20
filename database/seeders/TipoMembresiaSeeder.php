<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMembresiaSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('tipo_membresia')->insert([
            ['nombre' => 'Mensualidad General', 'duracion_dias' => 30, 'costo' => 500.00, 'descripcion' => 'Acceso total por 30 días', 'activo' => true],
            ['nombre' => 'Semanal', 'duracion_dias' => 7, 'costo' => 150.00, 'descripcion' => 'Acceso total por 7 días', 'activo' => true],
            ['nombre' => 'Anualidad VIP', 'duracion_dias' => 365, 'costo' => 4500.00, 'descripcion' => 'Acceso total y lockers incluidos por 1 año', 'activo' => true],
        ]);
    }
}
