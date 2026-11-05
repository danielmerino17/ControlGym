<?php

namespace Database\Seeders;

use App\Models\Cliente;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        Cliente::create([
            'nombre' => 'Carlos',
            'apellido_paterno' => 'Pérez',
            'apellido_materno' => 'Gómez',
            'telefono' => '5512345678',
            'correo' => 'carlos@gym.com',
            'fecha_registro' => Carbon::now(),
            'activo' => true,
        ]);

        Cliente::create([
            'nombre' => 'María',
            'apellido_paterno' => 'López',
            'apellido_materno' => 'Martínez',
            'telefono' => '5587654321',
            'correo' => 'maria@gym.com',
            'fecha_registro' => Carbon::now(),
            'activo' => true,
        ]);

        Cliente::firstOrCreate([
            'correo' => 'daniel@gym.com'
        ], [
            'nombre' => 'Daniel',
            'apellido_paterno' => 'Merino',
            'apellido_materno' => 'Mena',
            'telefono' => '5511223344',
            'fecha_registro' => Carbon::now(),
            'activo' => true,
        ]);
    }
}