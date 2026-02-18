<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('affiliate_products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('short_description')->nullable();
            $table->longText('full_description')->nullable();
            $table->json('specifications')->nullable();
            $table->string('price_min')->nullable();
            $table->string('price_max')->nullable();
            $table->json('images')->nullable();
            $table->string('whatsapp_number');
            $table->text('whatsapp_message_template');
            $table->boolean('is_available')->default(true);
            $table->integer('sort_order')->default(0);
            $table->unsignedBigInteger('views_count')->default(0);
            $table->timestamps();
            
            // Foreign key will be added after product_categories table is created
            $table->index(['category_id', 'is_available']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('affiliate_products');
    }
};