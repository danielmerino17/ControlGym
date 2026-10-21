<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('material')->insert([
            [
                'id_categoria' => 1,
                'nombre' => 'Mancuerna 10kg',
                'descripcion' => 'Mancuerna hexagonal de fierro con goma',
                'cantidad_total' => 20,
                'estado' => 'bueno',
                'activo' => true,
            ],
            [
                'id_categoria' => 2,
                'nombre' => 'Mat de Yoga',
                'descripcion' => 'Mat antiderrapante profesional',
                'cantidad_total' => 15,
                'estado' => 'bueno',
                'activo' => true,
            ],
        ]);
    }
}