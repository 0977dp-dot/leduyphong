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

    $table->string('productname', 150);
    $table->string('slug', 200)->unique();

    $table->decimal('price', 12, 2)->default(0);
    $table->decimal('pricediscount', 12, 2)->default(0);

    $table->string('image')->nullable();
    $table->text('description')->nullable();

    $table->tinyInteger('status')->default(1);

    $table->foreignId('brand_id')
        ->nullable()
        ->constrained('brands')
        ->nullOnDelete();
    $table->unsignedInteger('category_id');

    $table->foreign('category_id')
        ->references('cateid')
        ->on('categories')
        ->restrictOnDelete();

    $table->timestamps();
});
}
};