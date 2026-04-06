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
        Schema::create('vocations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->text('bonus_description')->nullable()->comment('Human-readable explanation of the vocation bonus');
            $table->string('bonus_type')->comment('ink_multiplier, hidden_notes, pinned_reviews');
            $table->string('bonus_value')->comment('The value for the bonus, e.g. "1.1", "true"');
            $table->foreignId('required_achievement_id')->nullable()->constrained('achievements')->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vocations');
    }
};
