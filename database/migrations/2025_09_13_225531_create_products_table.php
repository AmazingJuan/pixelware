<?php

/*
 * Products table migration
 * Migration for creating the products table.
 * Author: SJuan Avendaño
*/

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
            $table->integer('stock');
            $table->integer('price');
            $table->string('category');
            $table->json('specs')->nullable();
            $table->string('image_url')->default('favicon.ico');
            $table->float('average_rating')->default(0);
            $table->integer('reviews_count')->default(0);
            $table->integer('times_purchased')->default(0);
            $table->string('storage_driver')->default('local');
            $table->timestamps();
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
