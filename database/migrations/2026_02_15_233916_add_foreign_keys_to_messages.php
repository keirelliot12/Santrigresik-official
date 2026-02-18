<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            // Add columns if not exists
            if (!Schema::hasColumn('messages', 'contacted_at')) {
                $table->timestamp('contacted_at')->nullable()->after('updated_at');
            }
            
            if (!Schema::hasColumn('messages', 'converted_at')) {
                $table->timestamp('converted_at')->nullable()->after('contacted_at');
            }
            
            // Add indexes
            $table->index('status');
            if (Schema::hasColumn('messages', 'assigned_to')) {
                $table->index('assigned_to');
            }
        });
    }

    public function down(): void
    {
        Schema::table('messages', function (Blueprint $table) {
            $table->dropForeign(['assigned_to']);
            $table->dropColumn(['assigned_to', 'contacted_at', 'converted_at']);
            $table->dropIndex(['status', 'source']);
            $table->dropIndex(['assigned_to']);
        });
    }
};