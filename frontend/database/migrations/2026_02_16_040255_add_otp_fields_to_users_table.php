<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('phone')->nullable()->after('email');
            $table->string('otp_code')->nullable()->after('password');
            $table->timestamp('otp_expires_at')->nullable()->after('otp_code');
            $table->boolean('is_otp_verified')->default(false)->after('otp_expires_at');
            $table->string('login_method')->default('password')->after('is_otp_verified');
            
            $table->index('phone');
            $table->index('otp_code');
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['phone', 'otp_code', 'otp_expires_at', 'is_otp_verified', 'login_method']);
        });
    }
};