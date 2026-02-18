<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('affiliate_products', function (Blueprint $table) {
            $table->foreign('category_id')->references('id')->on('product_categories')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('affiliate_products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
        });
    }
};