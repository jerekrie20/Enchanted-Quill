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
        Schema::create('bosses', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->enum('type', ['site', 'author', 'book'])->default('site');
            $table->unsignedBigInteger('target_id')->nullable()->comment('user_id for author type, book_id for book type');
            $table->unsignedBigInteger('max_hp')->default(10000);
            $table->unsignedBigInteger('current_hp')->default(10000);
            $table->string('reward_code')->nullable()->comment('Discount code or reward identifier for victors');
            $table->boolean('is_active')->default(false);
            $table->timestamp('starts_at')->nullable();
            $table->timestamp('ends_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bosses');
    }
};
