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
        Schema::table('users', function (Blueprint $table) {
            $table->unsignedBigInteger('ink_total')->default(0)->after('bio')->comment('Total XP (Ink) earned by this user');
            $table->foreignId('vocation_id')->nullable()->after('ink_total')->constrained('vocations')->nullOnDelete()->comment('Discovered hidden class');
            $table->string('active_banner_path')->nullable()->after('vocation_id')->comment('Profile header banner image path');
            $table->string('active_title')->nullable()->after('active_banner_path')->comment('Title displayed next to username');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['vocation_id']);
            $table->dropColumn(['ink_total', 'vocation_id', 'active_banner_path', 'active_title']);
        });
    }
};
