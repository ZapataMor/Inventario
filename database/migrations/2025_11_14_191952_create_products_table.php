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
            $table->string('nombre', 150);
            $table->integer('cantidad_unidades');
            $table->date('fecha_vencimiento');
            $table->string('cantidad_porcion', 50);

            // Auditoría opcional
            $table->unsignedBigInteger('creado_por')->nullable();
            $table->unsignedBigInteger('actualizado_por')->nullable();

            $table->foreign('creado_por')->references('id')->on('users')->onDelete('set null');
            $table->foreign('actualizado_por')->references('id')->on('users')->onDelete('set null');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
