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
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('type', ['badge', 'title', 'banner']);
            $table->string('icon_path')->nullable()->comment('Path to badge icon image');
            $table->string('requirement_type')->comment('chapters_published, books_bookmarked, reviews_given, reviews_starred, etc.');
            $table->unsignedInteger('requirement_value')->default(1);
            $table->boolean('is_hidden')->default(false)->comment('Hidden until earned');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('achievements');
    }
};
