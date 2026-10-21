<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class SeguridadSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Insertar el rol de Administrador
        $idRol = DB::table('rol')->insertGetId([
            'nombre' => 'Administrador',
            'descripcion' => 'Control total del sistema GymControl',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);

        // 2. Insertar o actualizar el usuario admin para evitar duplicados
        DB::table('usuario')->updateOrInsert(
            ['usuario' => 'admin'], // Condición para buscar si ya existe
            [
                'id_rol' => $idRol,
                'nombre_completo' => 'Admin Principal',
                'correo' => 'admin@gymcontrol.com',
                'contrasena_hash' => Hash::make('password123'),
                'activo' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }
}