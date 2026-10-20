<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClienteSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('cliente')->insert([
            [
                'nombre' => 'Carlos',
                'apellido_paterno' => 'Gómez',
                'apellido_materno' => 'Pérez',
                'telefono' => '5512345678',
                'correo' => 'carlos.gomez@example.com',
                'documento_identidad' => 'INE987654321',
                'fecha_registro' => Carbon::now()->subDays(10),
                'contacto_emergencia' => 'María Gómez',
                'telefono_emergencia' => '5587654321',
                'observaciones' => 'Ninguna',
                'activo' => true,
            ],
            [
                'nombre' => 'Ana',
                'apellido_paterno' => 'López',
                'apellido_materno' => 'Martínez',
                'telefono' => '5598765432',
                'correo' => 'ana.lopez@example.com',
                'documento_identidad' => 'INE123456789',
                'fecha_registro' => Carbon::now()->subDays(5),
                'contacto_emergencia' => 'Jorge López',
                'telefono_emergencia' => '5511223344',
                'observaciones' => 'Lesión leve en rodilla',
                'activo' => true,
            ],
        ]);
    }
}
