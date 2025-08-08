<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Add resolved_at to tickets for tracking resolution time
        Schema::table('tickets', function (Blueprint $table) {
            if (!Schema::hasColumn('tickets', 'resolved_at')) {
                $table->timestamp('resolved_at')->nullable()->after('status');
                $table->index('resolved_at');
            }
        });

        // Knowledge base articles table
        if (!Schema::hasTable('knowledge_base_articles')) {
            Schema::create('knowledge_base_articles', function (Blueprint $table) {
                $table->id();
                $table->string('title');
                $table->string('slug')->unique();
                $table->string('category')->nullable();
                $table->longText('content');
                $table->unsignedInteger('views')->default(0);
                $table->boolean('published')->default(true);
                $table->timestamps();
            });
        }
    }

    public function down(): void
    {
        // Drop knowledge base table
        Schema::dropIfExists('knowledge_base_articles');

        // Remove resolved_at from tickets
        Schema::table('tickets', function (Blueprint $table) {
            if (Schema::hasColumn('tickets', 'resolved_at')) {
                $table->dropIndex(['resolved_at']);
                $table->dropColumn('resolved_at');
            }
        });
    }
};
