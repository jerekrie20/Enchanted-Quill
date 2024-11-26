<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('authors', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->text('bio');
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            $table->string('profile_image')->nullable();
            $table->timestamps();
            $table->softDeletes();

            //Add Index
            $table->index('user_id','email');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('authors');
    }
};
