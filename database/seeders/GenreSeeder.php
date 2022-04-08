<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->faker = Faker::create();
        DB::table('genres')->truncate();
        $values = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'dark'];
        $names = [
            'Action and Adventure',
            'Classics',
            'Comic Book or Graphic Novel',
            'Detective and Mystery',
            'Fantasy',
            'Historical Fiction',
            'Horror',
            'Literary Fiction'
        ];

        foreach ($values as $key => $value) {
            DB::table('genres')->insert([
                'name' => $names[$key],
                'style' => $value
            ]);
        }

        $genres = Genre::all();
        Book::all()->each(function ($book) use ($genres) {
            $book->genres()->attach(
                $genres->random(rand(1, 3))->pluck('id')->toArray()
            );
        });
    }
}
