<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Book;
use App\Models\Category;
use App\Models\Chapter;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Create Categories
        $categories = Category::factory(10)->create();

        // 2. Create the Admin User
        $admin = User::factory()->create([
            'name' => 'Jeremiah Kriegel',
            'email' => 'test@example.com',
            'email_verified_at' => now(),
            'password' => static::$password ??= Hash::make('password'),
            'role' => 'admin',
            'remember_token' => Str::random(10),
        ]);

        // 3. Create regular Users
        $users = User::factory(10)->create();

        // Let's get some users to act as authors
        $authors = $users->random(3)->push($admin);

        // 4. Create Blogs
        foreach ($authors as $author) {
            $blogs = Blog::factory(3)->create(['user_id' => $author->id]);
            // Attach random categories to blogs
            foreach ($blogs as $blog) {
                $blog->categories()->attach(
                    $categories->random(rand(1, 3))->pluck('id')->toArray()
                );
            }
        }

        // 5. Create Books & Chapters
        foreach ($authors as $author) {
            $books = Book::factory(2)->create(['user_id' => $author->id]);

            foreach ($books as $book) {
                // Attach random categories to books
                $book->categories()->attach(
                    $categories->random(rand(1, 3))->pluck('id')->toArray()
                );

                // Create chapters ensuring they start at 1 and increment
                $numChapters = rand(3, 8);
                for ($i = 1; $i <= $numChapters; $i++) {
                    Chapter::factory()->create([
                        'book_id' => $book->id,
                        'chapter_number' => $i,
                        'title' => "Chapter $i: ".fake()->sentence(3),
                    ]);
                }
            }
        }
    }
}
