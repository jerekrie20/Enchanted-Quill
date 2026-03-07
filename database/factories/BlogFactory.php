<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class BlogFactory extends Factory
{
    protected $model = Blog::class;

    public function definition(): array
    {
        $images = Storage::disk('public')->allFiles('blogs');
        $images = array_map(fn ($path) => str_replace('blogs/', '', $path), $images);

        return [
            'title' => $this->faker->sentence(),
            'slug' => $this->faker->slug(),
            'content' => $this->faker->paragraphs(10, true),
            'image' => count($images) > 0 ? $this->faker->randomElement($images) : null,
            'status' => $this->faker->randomElement([Blog::STATUS_DRAFT, Blog::STATUS_PUBLISHED, Blog::STATUS_PRIVATE]),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => User::factory(),
        ];
    }
}
