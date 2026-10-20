<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            UsuarioSeeder::class,
            TipoMembresiaSeeder::class,
            ClienteSeeder::class,
            MetodoPagoSeeder::class,
            MembresiaSeeder::class,
            PagoSeeder::class,
        ]);
    }
}