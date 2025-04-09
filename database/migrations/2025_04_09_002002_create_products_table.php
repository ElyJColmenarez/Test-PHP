<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description');
            $table->decimal('price', 12, 2);          // Precio en la moneda base
            $table->decimal('tax_cost', 12, 2);       // Costo de impuestos
            $table->decimal('manufacturing_cost', 12, 2); // Costo de fabricación
            $table->foreignId('currency_id')->constrained('currencies'); // Moneda base del producto
            $table->timestamps();

            // Índices
            $table->index('currency_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
