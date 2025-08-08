<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Extend tickets with priority, assigned_to, rating
        Schema::table('tickets', function (Blueprint $table) {
            if (!Schema::hasColumn('tickets', 'priority')) {
                $table->string('priority', 20)->default('Normal')->after('status');
                $table->index('priority');
            }
            if (!Schema::hasColumn('tickets', 'assigned_to')) {
                $table->foreignId('assigned_to')->nullable()->after('priority')->constrained('users')->nullOnDelete();
                $table->index('assigned_to');
            }
            if (!Schema::hasColumn('tickets', 'rating')) {
                $table->unsignedTinyInteger('rating')->nullable()->after('resolved_at'); // 1-5 rating by requestor
            }
        });

        // Notifications table (database channel)
        if (!Schema::hasTable('notifications')) {
            Schema::create('notifications', function (Blueprint $table) {
                $table->uuid('id')->primary();
                $table->string('type');
                $table->morphs('notifiable');
                $table->text('data');
                $table->timestamp('read_at')->nullable();
                $table->timestamps();
            });
        }

        // Chat-bot messages log
        if (!Schema::hasTable('ai_chat_messages')) {
            Schema::create('ai_chat_messages', function (Blueprint $table) {
                $table->id();
                $table->string('session_id', 64)->index();
                $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
                $table->enum('role', ['user', 'assistant', 'system'])->default('user');
                $table->longText('content');
                $table->unsignedInteger('tokens')->nullable();
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // Drop aux tables
        Schema::dropIfExists('ai_chat_messages');
        Schema::dropIfExists('notifications');

        // Revert tickets changes
        Schema::table('tickets', function (Blueprint $table) {
            if (Schema::hasColumn('tickets', 'rating')) {
                $table->dropColumn('rating');
            }
            if (Schema::hasColumn('tickets', 'assigned_to')) {
                $table->dropConstrainedForeignId('assigned_to');
                $table->dropIndex(['assigned_to']);
            }
            if (Schema::hasColumn('tickets', 'priority')) {
                $table->dropIndex(['priority']);
                $table->dropColumn('priority');
            }
        });
    }
};
