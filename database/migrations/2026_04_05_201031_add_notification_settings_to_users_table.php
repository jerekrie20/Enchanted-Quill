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
            $table->boolean('notify_messages')->default(true);
            $table->boolean('notify_book_updates')->default(true);
            $table->boolean('notify_publication')->default(true);
            $table->boolean('notify_author_actions')->default(true);
            $table->boolean('notify_new_users')->default(true);
            $table->boolean('notify_payments')->default(true);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'notify_messages',
                'notify_book_updates',
                'notify_publication',
                'notify_author_actions',
                'notify_new_users',
                'notify_payments',
            ]);
        });
    }
};
