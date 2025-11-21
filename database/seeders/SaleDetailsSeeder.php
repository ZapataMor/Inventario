<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SaleDetailsSeeder extends Seeder
{
    public function run(): void
    {
        // Venta 1 - Total: $70,500
        DB::table('sale_details')->insert([
            [
                'sale_id' => 1,
                'product_id' => 1, // Paracetamol 500mg - $8,500
                'cantidad' => 3,
                'precio_unitario' => 8500.00,
                'subtotal' => 25500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 1,
                'product_id' => 7, // Jarabe para la Tos 120ml - $22,000
                'cantidad' => 2,
                'precio_unitario' => 22000.00,
                'subtotal' => 44000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 1,
                'product_id' => 11, // Loratadina 10mg - $9,500
                'cantidad' => 1,
                'precio_unitario' => 9500.00,
                'subtotal' => 9500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Actualizar total de venta 1
        DB::table('sales')->where('id', 1)->update(['total' => 79000.00]);

        // Venta 2 - Total: $73,500
        DB::table('sale_details')->insert([
            [
                'sale_id' => 2,
                'product_id' => 4, // Amoxicilina 500mg - $25,000
                'cantidad' => 2,
                'precio_unitario' => 25000.00,
                'subtotal' => 50000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 2,
                'product_id' => 2, // Ibuprofeno 400mg - $15,000
                'cantidad' => 1,
                'precio_unitario' => 15000.00,
                'subtotal' => 15000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 2,
                'product_id' => 8, // Solución Salina 250ml - $8,000
                'cantidad' => 1,
                'precio_unitario' => 8000.00,
                'subtotal' => 8000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Actualizar total de venta 2
        DB::table('sales')->where('id', 2)->update(['total' => 73000.00]);

        // Venta 3 - Total: $112,000
        DB::table('sale_details')->insert([
            [
                'sale_id' => 3,
                'product_id' => 6, // Cefalexina 500mg - $32,000
                'cantidad' => 2,
                'precio_unitario' => 32000.00,
                'subtotal' => 64000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 3,
                'product_id' => 9, // Jarabe Ambroxol 120ml - $28,000
                'cantidad' => 1,
                'precio_unitario' => 28000.00,
                'subtotal' => 28000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 3,
                'product_id' => 13, // Omeprazol 20mg - $16,500
                'cantidad' => 1,
                'precio_unitario' => 16500.00,
                'subtotal' => 16500.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 3,
                'product_id' => 3, // Acetaminofén 500mg - $12,000
                'cantidad' => 1,
                'precio_unitario' => 12000.00,
                'subtotal' => 12000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Actualizar total de venta 3
        DB::table('sales')->where('id', 3)->update(['total' => 120500.00]);

        // Venta 4 - Total: $85,500
        DB::table('sale_details')->insert([
            [
                'sale_id' => 4,
                'product_id' => 16, // Vitamina C 1000mg - $24,000
                'cantidad' => 2,
                'precio_unitario' => 24000.00,
                'subtotal' => 48000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 4,
                'product_id' => 17, // Complejo B - $18,500
                'cantidad' => 2,
                'precio_unitario' => 18500.00,
                'subtotal' => 37000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Actualizar total de venta 4
        DB::table('sales')->where('id', 4)->update(['total' => 85000.00]);

        // Venta 5 - Total: $127,000
        DB::table('sale_details')->insert([
            [
                'sale_id' => 5,
                'product_id' => 5, // Azitromicina 500mg - $18,000
                'cantidad' => 3,
                'precio_unitario' => 18000.00,
                'subtotal' => 54000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 5,
                'product_id' => 12, // Dolex Gripa - $11,000
                'cantidad' => 4,
                'precio_unitario' => 11000.00,
                'subtotal' => 44000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'sale_id' => 5,
                'product_id' => 10, // Suero Oral Pedialyte 500ml - $15,000
                'cantidad' => 2,
                'precio_unitario' => 15000.00,
                'subtotal' => 30000.00,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);

        // Actualizar total de venta 5
        DB::table('sales')->where('id', 5)->update(['total' => 128000.00]);
    }
}