<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->string('seo_title')->nullable()->after('color');
            $table->text('seo_description')->nullable()->after('seo_title');
            $table->string('pricing_starts_from')->nullable()->after('price_note');
            $table->unsignedBigInteger('views_count')->default(0)->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('services', function (Blueprint $table) {
            $table->dropColumn(['seo_title', 'seo_description', 'pricing_starts_from', 'views_count']);
        });
    }
};