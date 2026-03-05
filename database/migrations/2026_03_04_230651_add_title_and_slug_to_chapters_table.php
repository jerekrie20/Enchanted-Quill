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
        // Check if columns don't exist before adding them
        if (! Schema::hasColumn('chapters', 'title')) {
            Schema::table('chapters', function (Blueprint $table) {
                $table->string('title')->nullable()->after('chapter_number');
            });
        }

        if (! Schema::hasColumn('chapters', 'slug')) {
            Schema::table('chapters', function (Blueprint $table) {
                $table->string('slug')->nullable()->after('title');
            });
        }

        // Update existing chapters with default values
        $chapters = DB::table('chapters')->whereNull('title')->orWhereNull('slug')->get();
        foreach ($chapters as $chapter) {
            $title = $chapter->title ?? 'Chapter '.$chapter->chapter_number;
            $slug = $chapter->slug ?? 'chapter-'.$chapter->chapter_number.'-'.uniqid();

            DB::table('chapters')
                ->where('id', $chapter->id)
                ->update([
                    'title' => $title,
                    'slug' => $slug,
                ]);
        }

        // Now make them required and add unique constraint if not already present
        Schema::table('chapters', function (Blueprint $table) {
            $table->string('title')->nullable(false)->change();
        });

        // Check if unique index doesn't exist before adding it
        $indexes = Schema::getIndexes('chapters');
        $slugIndexExists = collect($indexes)->contains(fn ($index) => $index['name'] === 'chapters_slug_unique');

        if (! $slugIndexExists) {
            Schema::table('chapters', function (Blueprint $table) {
                $table->string('slug')->unique()->nullable(false)->change();
            });
        } else {
            Schema::table('chapters', function (Blueprint $table) {
                $table->string('slug')->nullable(false)->change();
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('chapters', function (Blueprint $table) {
            $table->dropColumn(['title', 'slug']);
        });
    }
};
