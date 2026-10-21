<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolPermisoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('rol_permiso')->insert([
            ['id_rol' => 1, 'id_permiso' => 1], // Administrador tiene permiso 1
            ['id_rol' => 1, 'id_permiso' => 2], // Administrador tiene permiso 2
            ['id_rol' => 1, 'id_permiso' => 3], // Administrador tiene permiso 3
            ['id_rol' => 2, 'id_permiso' => 2], // Recepcionista solo tiene permiso 2
        ]);
    }
}