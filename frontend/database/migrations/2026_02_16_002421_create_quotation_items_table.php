<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotation_items', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('quotation_id');
            $table->string('service_name');
            $table->text('description')->nullable();
            $table->integer('quantity')->default(1);
            $table->decimal('unit_price', 15, 2);
            $table->decimal('total', 15, 2);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
            
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('cascade');
            $table->index('quotation_id');
            $table->index('sort_order');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotation_items');
    }
};