<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuario')->insert([
            'id_rol' => 1,
            'nombre_completo' => 'Administrador General',
            'usuario' => 'admin',
            'correo' => 'admin@controlgym.com',
            'contrasena_hash' => Hash::make('password123'),
            'activo' => true,
        ]);
    }
}