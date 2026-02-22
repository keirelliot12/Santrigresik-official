<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('inquiry_notes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('message_id');
            $table->uuid('user_id');
            $table->text('note');
            $table->enum('type', ['call', 'email', 'meeting', 'note', 'follow_up'])->default('note');
            $table->timestamp('created_at')->useCurrent();
            
            $table->foreign('message_id')->references('id')->on('messages')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->index(['message_id', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('inquiry_notes');
    }
};