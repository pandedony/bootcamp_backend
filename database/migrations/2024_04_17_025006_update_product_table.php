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
        Schema::table('products', function (Blueprint $table) {
            $table->integer('stock')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('shipping')->nullable();
            $table->string('category')->nullable();
            $table->text('images')->nullable();
            $table->text('image')->nullable();
            $table->integer('reviews')->nullable();
            $table->float('stars', 3, 1)->nullable();
            $table->string('name')->nullable();
            $table->text('description')->nullable()->change();
            $table->string('company')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('stock');
            $table->dropColumn('featured');
            $table->dropColumn('shipping');
            $table->dropColumn('category');
            $table->dropColumn('images');
            $table->dropColumn('image');
            $table->dropColumn('reviews');
            $table->dropColumn('stars');
            $table->dropColumn('name');
            $table->string('description')->change();
            $table->dropColumn('company');
        });
    }
};
