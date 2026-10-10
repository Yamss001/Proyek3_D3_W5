<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('cart_items', function (Blueprint $table) {
            $table->id('id_cart_item');
            $table->unsignedBigInteger('id_cart');
            $table->string('id_barang', 10);
            $table->integer('jumlah')->default(1);

            $table->foreign('id_cart')
                ->references('id_cart')
                ->on('carts')
                ->cascadeOnDelete();

            $table->foreign('id_barang')
                ->references('id_barang')
                ->on('products')
                ->cascadeOnDelete();

            $table->unique(['id_cart', 'id_barang']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};
