<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Genre;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->truncate();
        $values = ['primary', 'secondary', 'success', 'danger', 'warning', 'info', 'light', 'dark'];

        foreach ($values as $key => $value) {
            DB::table('genres')->insert([
                'name' => 'Genre ' . $key + 1,
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
