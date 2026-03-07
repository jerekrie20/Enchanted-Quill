<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class BookFactory extends Factory
{
    protected $model = Book::class;

    public function definition(): array
    {
        $covers = Storage::disk('public')->allFiles('books');
        $covers = array_map(fn ($path) => str_replace('books/', '', $path), $covers);

        return [
            'title' => $this->faker->sentence(3),
            'slug' => $this->faker->slug(),
            'description' => $this->faker->paragraphs(3, true),
            'cover' => count($covers) > 0 ? $this->faker->randomElement($covers) : null,
            'status' => Book::STATUS_PUBLISHED,
            'is_public' => true,
            'published_at' => Carbon::now(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => User::factory()->author(),
        ];
    }
}
