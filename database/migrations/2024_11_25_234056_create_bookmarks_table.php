<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookmarks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->morphs('bookmarkable'); // Includes 'bookmarkable_id' and 'bookmarkable_type'
            $table->timestamps();
        });;
    }

    public function down(): void
    {
        Schema::dropIfExists('bookmarks');
    }
};
