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

            $table->string('productname', 150);
            $table->string('slug', 200)->unique();

            $table->decimal('price', 12, 2)->default(0);
            $table->decimal('pricediscount', 12, 2)->default(0);

            $table->string('image')->nullable();
            $table->text('description')->nullable();

            $table->tinyInteger('status')->default(1);

            // Thương hiệu
            $table->unsignedBigInteger('brandid')->nullable();

            $table->foreign('brandid')
                ->references('id')
                ->on('brands')
                ->nullOnDelete();


            // Danh mục
            $table->unsignedInteger('catid');

            $table->foreign('catid')
                ->references('cateid')
                ->on('categories')
                ->restrictOnDelete();


            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};