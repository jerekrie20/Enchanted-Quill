<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->longText('content');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->smallInteger('status')->default(0);
            $table->string('image')->nullable();
            $table->timestamps();
            $table->softDeletes();

            // Add indexes for optimization
            $table->index('slug', 'status');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
