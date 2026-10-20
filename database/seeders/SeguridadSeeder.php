<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Rol;
use App\Models\User;

class SeguridadSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Crear Rol Administrador
        $rolAdmin = Rol::create([
            'nombre' => 'Administrador',
            'descripcion' => 'Control total del sistema GymControl'
        ]);

        // 2. Crear un usuario administrador por defecto
        User::create([
            'name' => 'Admin Principal',
            'email' => 'admin@gymcontrol.com',
            'password' => bcrypt('password123'),
            'rol_id' => $rolAdmin->id,
        ]);
    }
}