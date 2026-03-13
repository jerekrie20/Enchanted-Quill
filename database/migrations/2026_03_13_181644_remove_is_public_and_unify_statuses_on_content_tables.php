<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Update books
        DB::table('books')->where('status', 3)->update(['status' => 4]); // Archived
        DB::table('books')->where('status', 2)->update(['status' => 3]); // Publish Later
        DB::table('books')->where('status', 1)->where('is_public', 0)->update(['status' => 2]); // Published but not public -> Private

        // Update chapters
        DB::table('chapters')->where('status', 3)->update(['status' => 4]); // Archived
        DB::table('chapters')->where('status', 2)->update(['status' => 3]); // Publish Later
        DB::table('chapters')->where('status', 1)->where('is_public', 0)->update(['status' => 2]); // Published but not public -> Private

        // Update blogs
        // Blogs already had 2 = Private and 3 = Publish later. We just need to catch any 1 but is_public = 0
        DB::table('blogs')->where('status', 1)->where('is_public', 0)->update(['status' => 2]);

        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('is_public');
        });

        Schema::table('chapters', function (Blueprint $table) {
            $table->dropColumn('is_public');
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->dropColumn('is_public');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->boolean('is_public')->default(true);
        });

        Schema::table('chapters', function (Blueprint $table) {
            $table->boolean('is_public')->default(true);
        });

        Schema::table('blogs', function (Blueprint $table) {
            $table->boolean('is_public')->default(true);
        });

        // Best effort rollback
        DB::table('books')->where('status', 2)->update(['status' => 1, 'is_public' => 0]);
        DB::table('books')->where('status', 3)->update(['status' => 2]);
        DB::table('books')->where('status', 4)->update(['status' => 3]);

        DB::table('chapters')->where('status', 2)->update(['status' => 1, 'is_public' => 0]);
        DB::table('chapters')->where('status', 3)->update(['status' => 2]);
        DB::table('chapters')->where('status', 4)->update(['status' => 3]);

        DB::table('blogs')->where('status', 2)->update(['is_public' => 0]); // Assuming it was 1 before
    }
};
