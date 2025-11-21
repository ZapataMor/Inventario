<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 100);
            $table->integer('cantidad_unidades');
            $table->date('fecha_vencimiento');
            $table->decimal('peso_por_unidad', 8, 2);
            $table->decimal('precio_unitario', 10, 2)->default(0);
            $table->enum('tipo_unidad', ['mg', 'ml'])->default('mg');
            
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->foreign('creado_por')->references('id')->on('users')->onDelete('set null');
            
            $table->unsignedBigInteger('actualizado_por')->nullable();
            $table->foreign('actualizado_por')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};