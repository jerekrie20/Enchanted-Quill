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
        // Add indexes to users table
        Schema::table('users', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('role');
            $table->index('last_active');
        });

        // Add indexes to books table
        Schema::table('books', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('status');
            $table->index('published_at');
            $table->index(['author_id', 'status']);
        });

        // Add indexes to blogs table
        Schema::table('blogs', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('status');
            $table->index(['user_id', 'status']);
        });

        // Add indexes to comments table
        Schema::table('comments', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('user_id');
            $table->index('blog_id');
        });

        // Add indexes to reviews table
        Schema::table('reviews', function (Blueprint $table) {
            $table->index('created_at');
            $table->index('user_id');
            $table->index('book_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Remove indexes from users table
        Schema::table('users', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['role']);
            $table->dropIndex(['last_active']);
        });

        // Remove indexes from books table
        Schema::table('books', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['status']);
            $table->dropIndex(['published_at']);
            $table->dropIndex(['author_id', 'status']);
        });

        // Remove indexes from blogs table
        Schema::table('blogs', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['status']);
            $table->dropIndex(['user_id', 'status']);
        });

        // Remove indexes from comments table
        Schema::table('comments', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['blog_id']);
        });

        // Remove indexes from reviews table
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropIndex(['created_at']);
            $table->dropIndex(['user_id']);
            $table->dropIndex(['book_id']);
        });
    }
};
