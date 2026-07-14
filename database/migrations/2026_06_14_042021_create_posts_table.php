<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->string('title', 200);
            $table->string('slug', 255)->unique();
            $table->text('content')->nullable();
            $table->string('image', 200)->nullable();
            $table->tinyInteger('status')->default(1);

            $table->unsignedInteger('user_id');

            $table->foreign('user_id')
                ->references('userid')
                ->on('users')
                ->restrictOnDelete();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('posts');
    }
};
