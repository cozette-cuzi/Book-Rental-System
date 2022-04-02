<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class BookGenreFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'book_id' => \rand(1, 20),
            'genre_id' => rand(1, 8)
        ];
    }
}
