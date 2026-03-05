<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasColumn('chapters', 'slug')) {
            Schema::table('chapters', function (Blueprint $table) {
                $table->dropUnique(['slug']);
                $table->dropColumn('slug');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (! Schema::hasColumn('chapters', 'slug')) {
            Schema::table('chapters', function (Blueprint $table) {
                $table->string('slug')->after('title');
            });

            Schema::table('chapters', function (Blueprint $table) {
                $table->unique('slug');
            });
        }
    }
};
