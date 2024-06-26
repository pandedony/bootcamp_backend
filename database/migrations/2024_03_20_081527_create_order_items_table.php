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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->integer('quantity')->nullable();
            $table->string('color')->nullable();

            $table->unsignedBigInteger('orderId')->nullable();
            $table->unsignedBigInteger('productId')->nullable();

            $table->foreign('orderId')->references('id')->on('orders')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('productId')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
