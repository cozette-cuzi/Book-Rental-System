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
            'name' => $this->faker->name(),
            'authors' => $this->faker->lastName(),
            'released_at' => Carbon::now(), // password
            'pages' => rand(200, 400),
            'language_code' => $this->faker->randomElement(['hu', 'en', 'fr', 'ar']),
            'isbn' => $this->faker->unique()->uuid(),
            'in_stock' => rand(0, 30),
        ];
    }
}
