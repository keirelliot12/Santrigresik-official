<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('payment_number')->unique();
            $table->uuid('quotation_id')->nullable();
            $table->uuid('client_id')->nullable();
            $table->decimal('amount', 15, 2);
            $table->decimal('fee', 15, 2)->default(0);
            $table->decimal('net_amount', 15, 2);
            $table->enum('status', ['pending', 'paid', 'failed', 'refunded'])->default('pending');
            $table->enum('method', ['midtrans', 'ovo', 'gopay', 'bank_transfer', 'cash']);
            $table->string('provider_reference')->nullable();
            $table->json('provider_response')->nullable();
            $table->timestamp('paid_at')->nullable();
            $table->timestamp('expired_at')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
            
            $table->foreign('quotation_id')->references('id')->on('quotations')->onDelete('set null');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('set null');
            $table->index(['status', 'method']);
            $table->index('payment_number');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};