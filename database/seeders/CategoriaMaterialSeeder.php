<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaMaterialSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('categoria_material')->insert([
            ['nombre' => 'Pesas y Mancuernas', 'descripcion' => 'Equipamiento de peso libre'],
            ['nombre' => 'Accesorios de Yoga', 'descripcion' => 'Mats, bloques y bandas elásticas'],
        ]);
    }
}