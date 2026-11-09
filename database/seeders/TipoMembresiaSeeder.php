<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoMembresiaSeeder extends Seeder
{
    public function run(): void
    {
        // Se registran los tipos de membresía. 
        $tipos = [
            ['nombre' => 'Pase Diario', 'duracion_dias' => 1, 'costo' => 80.00, 'activo' => true],
            ['nombre' => 'Semanal', 'duracion_dias' => 7, 'costo' => 250.00, 'activo' => true],
            ['nombre' => 'Mensual', 'duracion_dias' => 30, 'costo' => 450.00, 'activo' => true],
            ['nombre' => 'Estudiante', 'duracion_dias' => 30, 'costo' => 350.00, 'activo' => true],
            ['nombre' => 'Trimestral', 'duracion_dias' => 90, 'costo' => 1200.00, 'activo' => true],
            ['nombre' => 'Semestral', 'duracion_dias' => 180, 'costo' => 2100.00, 'activo' => true],
            ['nombre' => 'Anual', 'duracion_dias' => 360, 'costo' => 750.00, 'activo' => true],
            ['nombre' => 'Premium Mensual', 'duracion_dias' => 30, 'costo' => 750.00, 'activo' => false],
        ];

        // Se insertan o actualizan los tipos de membresía en la base de datos.
        foreach ($tipos as $tipo) {
            DB::table('tipo_membresia')->updateOrInsert(
                ['nombre' => $tipo['nombre']], // Condición de búsqueda única
                $tipo
            );
        }
    }
}