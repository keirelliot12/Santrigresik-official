<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analytics_summary', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('metric_type'); // leads, revenue, views, etc
            $table->string('metric_subtype')->nullable(); // source, category, etc
            $table->decimal('value', 15, 2)->default(0);
            $table->integer('count')->default(0);
            $table->json('metadata')->nullable();
            $table->timestamps();
            
            $table->unique(['date', 'metric_type', 'metric_subtype']);
            $table->index(['date', 'metric_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analytics_summary');
    }
};