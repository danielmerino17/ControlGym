<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MaterialSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('material')->insert([
            // Categoría 1: Pesas y Mancuernas
            [
                'id_categoria' => 1,
                'nombre' => 'Mancuerna 10kg',
                'descripcion' => 'Mancuerna hexagonal de fierro con goma',
                'cantidad_total' => 20,
                'estado' => 'bueno',
                'activo' => true,
            ],
            [
                'id_categoria' => 1,
                'nombre' => 'Disco Olímpico 20kg',
                'descripcion' => 'Disco recubierto de uretano con agarres',
                'cantidad_total' => 30,
                'estado' => 'bueno',
                'activo' => true,
            ],
            [
                'id_categoria' => 1,
                'nombre' => 'Pesa Rusa (Kettlebell) 15kg',
                'descripcion' => 'Pesa rusa de hierro fundido',
                'cantidad_total' => 10,
                'estado' => 'bueno',
                'activo' => true,
            ],
            [
                'id_categoria' => 1,
                'nombre' => 'Barra Olímpica Z',
                'descripcion' => 'Barra curva para bíceps y tríceps',
                'cantidad_total' => 5,
                'estado' => 'regular',
                'activo' => true,
            ],

            // Categoría 2: Accesorios de Yoga
            [
                'id_categoria' => 2,
                'nombre' => 'Mat de Yoga',
                'descripcion' => 'Mat antiderrapante profesional',
                'cantidad_total' => 15,
                'estado' => 'bueno',
                'activo' => true,
            ],
            [
                'id_categoria' => 2,
                'nombre' => 'Bloque de Yoga',
                'descripcion' => 'Bloque de espuma EVA de alta densidad',
                'cantidad_total' => 25,
                'estado' => 'bueno',
                'activo' => true,
            ],
            [
                'id_categoria' => 2,
                'nombre' => 'Banda de Resistencia (Fuerte)',
                'descripcion' => 'Banda elástica cerrada para glúteos y piernas',
                'cantidad_total' => 40,
                'estado' => 'bueno',
                'activo' => true,
            ],
            [
                'id_categoria' => 2,
                'nombre' => 'Rodillo de Espuma (Foam Roller)',
                'descripcion' => 'Rodillo texturizado para masaje muscular',
                'cantidad_total' => 8,
                'estado' => 'bueno',
                'activo' => true,
            ],
        ]);
    }
}