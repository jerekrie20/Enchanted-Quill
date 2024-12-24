<?php

namespace Database\Seeders;

use App\Models\Author;
use App\Models\Blog;
use App\Models\Book;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    public function run(): void
    {
        User::factory(10)->create();

        User::factory()->create([
            'name' => 'Jeremiah Kriegel',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);

        Blog::factory(10)->create();
        Book::factory(5)->create();
        Chapter::factory(10)->create();
        Category::factory(10)->create();
    }
}
