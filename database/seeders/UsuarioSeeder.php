<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class UsuarioSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('usuarios')->updateOrInsert(
            ['email' => 'admin@gym.com'],
            [
                'name' => 'Administrador',
                'password' => Hash::make('12345'),
                'activo' => true,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        );
    }
}