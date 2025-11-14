<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    public function run(): void
    {
        // Usuario administrador
        DB::table('users')->insert([
            'nombre' => 'Administrador',
            'email' => 'admin@farmacia.com',
            'password' => Hash::make('admin123'),
            'role_id' => 1, // El rol 'admin'
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Usuario empleado opcional
        DB::table('users')->insert([
            'nombre' => 'Empleado',
            'email' => 'empleado@farmacia.com',
            'password' => Hash::make('empleado123'),
            'role_id' => 2, // El rol 'empleado'
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
