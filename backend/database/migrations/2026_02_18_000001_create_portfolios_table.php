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
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('category'); // Website, Aplikasi, Sistem
            $table->text('description');
            $table->string('image_url')->nullable();
            $table->json('technologies')->nullable();
            $table->string('client')->nullable();
            $table->string('year')->nullable();
            $table->string('url')->nullable();
            $table->string('color')->default('#000000');
            $table->string('icon')->default('globe');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('portfolios');
    }
};
