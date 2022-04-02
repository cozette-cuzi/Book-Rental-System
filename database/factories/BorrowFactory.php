<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BorrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'reader_id' => rand(1, 10),
            'book_id' => rand(1, 20),
            'status' =>  $this->faker->randomElement(['PENDING', 'ACCEPTED', 'REJECTED']),
            'request_processed_at' => Carbon::now(),
            'request_managed_by' => 1,
            'deadline' => Carbon::now()->addDays(rand(7, 30))
        ];
    }
}
