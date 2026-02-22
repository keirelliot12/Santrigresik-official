<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('company_name');
            $table->string('contact_person');
            $table->string('email');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->string('website')->nullable();
            $table->string('industry')->nullable();
            $table->decimal('total_projects', 15, 2)->default(0);
            $table->decimal('total_revenue', 15, 2)->default(0);
            $table->date('last_project_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'prospect'])->default('prospect');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index(['status', 'company_name']);
            $table->unique('email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};