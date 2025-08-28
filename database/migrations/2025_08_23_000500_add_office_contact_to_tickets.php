<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            if (!Schema::hasColumn('tickets', 'office_contact')) {
                $table->string('office_contact', 100)->nullable()->after('requestor_name');
                $table->index('office_contact');
            }
        });
    }

    public function down(): void
    {
        Schema::table('tickets', function (Blueprint $table) {
            if (Schema::hasColumn('tickets', 'office_contact')) {
                $table->dropIndex(['office_contact']);
                $table->dropColumn('office_contact');
            }
        });
    }
};
