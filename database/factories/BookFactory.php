<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => rtrim($this->faker->sentence(rand(2, 5), true), '.'),
            'authors' => $this->faker->name(),
            'released_at' => Carbon::now()->toDateString(),
            'pages' => rand(200, 400),
            'language_code' => $this->faker->randomElement(['hu', 'en', 'fr', 'ar']),
            'isbn' => $this->faker->unique()->isbn13(),
            'description' => $this->faker->sentence(rand(30, 50), true),
            'cover_image' => $this->faker->image('public/uploads/cover_images', 200, 300, null, false),
            'in_stock' => rand(0, 30),
        ];
    }
}
