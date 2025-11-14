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
                'product_id' => 1, // Paracetamol
                'cantidad' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 1,
                'product_id' => 2, // Ibuprofeno
                'cantidad' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 2,
                'product_id' => 3, // Amoxicilina
                'cantidad' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]
        ]);
    }
}
