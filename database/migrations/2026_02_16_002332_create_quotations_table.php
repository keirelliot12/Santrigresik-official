<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quotations', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('quote_number')->unique();
            $table->uuid('client_id')->nullable();
            $table->unsignedBigInteger('message_id')->nullable();
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('valid_until');
            $table->decimal('subtotal', 15, 2)->default(0);
            $table->decimal('discount', 15, 2)->default(0);
            $table->decimal('tax', 15, 2)->default(0);
            $table->decimal('total', 15, 2)->default(0);
            $table->enum('status', ['draft', 'sent', 'viewed', 'accepted', 'rejected', 'expired'])->default('draft');
            $table->text('notes')->nullable();
            $table->string('access_token')->unique();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('viewed_at')->nullable();
            $table->timestamp('accepted_at')->nullable();
            $table->uuid('created_by');
            $table->timestamps();
            
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('set null');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->index(['status', 'created_at']);
            $table->index('quote_number');
            $table->index('access_token');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quotations');
    }
};