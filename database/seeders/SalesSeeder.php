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
                'user_id' => 2,
                'fecha_venta' => '2025-01-10 09:30:00',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'user_id' => 2,
                'fecha_venta' => '2025-01-12 15:45:00',
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
