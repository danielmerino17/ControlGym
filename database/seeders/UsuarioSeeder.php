<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Faker\Factory as Faker;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        $faker = Faker::create('es_MX');

        for ($i = 0; $i < 20; $i++) {
            DB::table('cliente')->insert([
                'nombre' => $faker->firstName,
                'apellido_paterno' => $faker->lastName,
                'apellido_materno' => $faker->lastName,
                'telefono' => $faker->numerify('55########'),
                'correo' => $faker->unique()->safeEmail,
                'fecha_registro' => clone $faker->dateTimeBetween('-2 months', 'now'),
                'activo' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}