<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('company_name')->nullable();
            $table->string('contact_person');
            $table->string('email');
            $table->string('phone');
            $table->text('address')->nullable();
            $table->string('website')->nullable();
            $table->string('industry')->nullable();
            $table->decimal('total_projects', 10, 2)->default(0);
            $table->decimal('total_revenue', 15, 2)->default(0);
            $table->date('last_project_date')->nullable();
            $table->enum('status', ['active', 'inactive', 'blocked'])->default('active');
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->index('email');
            $table->index('status');
            $table->index('last_project_date');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};