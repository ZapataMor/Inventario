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
            
            $table->unsignedBigInteger('creado_por');
            $table->foreign('creado_por')->references('id')->on('users')->onDelete('cascade');
            
            $table->unsignedBigInteger('actualizado_por');
            $table->foreign('actualizado_por')->references('id')->on('users')->onDelete('cascade');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
