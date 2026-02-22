<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // Drop existing foreign key jika ada
            $table->dropForeign(['assigned_to']);
            
            // Ubah tipe data ke UUID
            $table->uuid('assigned_to')->nullable()->change();
            
            // Tambahkan foreign key baru
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['assigned_to']);
            $table->unsignedBigInteger('assigned_to')->nullable()->change();
            $table->foreign('assigned_to')->references('id')->on('users')->onDelete('set null');
        });
    }
};