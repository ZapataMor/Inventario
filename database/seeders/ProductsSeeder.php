<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'nombre' => 'Paracetamol 500mg',
                'cantidad_unidades' => 120,
                'fecha_vencimiento' => '2026-05-10',
                'cantidad_porcion' => '500 mg',
                'creado_por' => 1,
                'actualizado_por' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ibuprofeno 400mg',
                'cantidad_unidades' => 80,
                'fecha_vencimiento' => '2025-11-03',
                'cantidad_porcion' => '400 mg',
                'creado_por' => 1,
                'actualizado_por' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Amoxicilina 500mg',
                'cantidad_unidades' => 60,
                'fecha_vencimiento' => '2027-01-15',
                'cantidad_porcion' => '500 mg',
                'creado_por' => 1,
                'actualizado_por' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
