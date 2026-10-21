<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            // 1. Módulo de Seguridad (Sin SeguridadSeeder para no duplicar)
            RolSeeder::class,
            PermisoSeeder::class,
            RolPermisoSeeder::class,
            UsuarioSeeder::class,
            BitacoraSeeder::class,

            // 2. Módulo de Membresías y Pagos
            TipoMembresiaSeeder::class,
            ClienteSeeder::class,
            MetodoPagoSeeder::class,
            MembresiaSeeder::class,
            PagoSeeder::class,

            // 3. Módulo de Inventario y Préstamos
            CategoriaMaterialSeeder::class,
            MaterialSeeder::class,
            MovimientoInventarioSeeder::class,
            PrestamoSeeder::class,
            DetallePrestamoSeeder::class,
        ]);
    }
}