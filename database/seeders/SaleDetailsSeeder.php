<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleDetailsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('sale_details')->insert([
            [
                'sale_id' => 1,
                'product_id' => 1, // Paracetamol (0.5 kg/unidad)
                'cantidad' => 2,
                'subtotal' => 1.0, // 0.5 * 2
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 1,
                'product_id' => 2, // Ibuprofeno (0.4 kg/unidad)
                'cantidad' => 1,
                'subtotal' => 0.4, // 0.4 * 1
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 2,
                'product_id' => 3, // Amoxicilina (0.5 kg/unidad)
                'cantidad' => 1,
                'subtotal' => 0.5, // 0.5 * 1
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
