<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_images', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('portfolio_id');
            $table->string('image_url');
            $table->string('caption')->nullable();
            $table->integer('display_order')->default(0);
            $table->timestamps();
            
            $table->foreign('portfolio_id')->references('id')->on('portfolios')->onDelete('cascade');
            $table->index(['portfolio_id', 'display_order']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_images');
    }
};