<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('client_name')->nullable()->after('category');
            $table->string('client_industry')->nullable()->after('client_name');
            $table->string('client_website')->nullable()->after('client_industry');
            $table->text('challenge')->nullable()->after('description');
            $table->text('solution')->nullable()->after('challenge');
            $table->json('results')->nullable()->after('solution');
            $table->string('project_url')->nullable()->after('url');
            $table->date('completion_date')->nullable()->after('year');
            $table->unsignedBigInteger('views_count')->default(0)->after('is_active');
        });
    }

    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn([
                'client_name',
                'client_industry', 
                'client_website',
                'challenge',
                'solution',
                'results',
                'project_url',
                'completion_date',
                'views_count'
            ]);
        });
    }
};