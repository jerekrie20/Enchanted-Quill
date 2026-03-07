<?php

namespace Database\Factories;

use App\Models\Book;
use App\Models\Chapter;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class ChapterFactory extends Factory
{
    protected $model = Chapter::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'chapter_number' => $this->faker->numberBetween(1, 10),
            'content' => $this->faker->paragraphs(20, true),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'book_id' => Book::factory(),
        ];
    }
}
