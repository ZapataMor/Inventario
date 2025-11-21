<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sales')->insert([
            [
                'user_id' => 2, // Empleado
                'fecha_venta' => '2025-01-10 09:30:00',
                'total' => 0, // Se actualizará con el seeder de detalles
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Empleado
                'fecha_venta' => '2025-01-12 15:45:00',
                'total' => 0, // Se actualizará con el seeder de detalles
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 1, // Admin
                'fecha_venta' => '2025-01-15 11:20:00',
                'total' => 0, // Se actualizará con el seeder de detalles
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Empleado
                'fecha_venta' => '2025-01-18 14:10:00',
                'total' => 0, // Se actualizará con el seeder de detalles
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2, // Empleado
                'fecha_venta' => '2025-01-20 10:00:00',
                'total' => 0, // Se actualizará con el seeder de detalles
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}