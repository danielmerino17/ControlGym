<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermisoSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('permiso')->insert([
            ['id_permiso' => 1, 'nombre' => 'crear_usuarios', 'modulo' => 'Seguridad'],
            ['id_permiso' => 2, 'nombre' => 'registrar_pagos', 'modulo' => 'Finanzas'],
            ['id_permiso' => 3, 'nombre' => 'gestionar_inventario', 'modulo' => 'Inventario'],
        ]);
    }
}