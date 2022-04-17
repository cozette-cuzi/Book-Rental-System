<?php

namespace Database\Seeders;

use App\Models\Borrow;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BorrowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('borrows')->truncate();
        // ACCPETED
        DB::table('borrows')->insert([
            'reader_id' => rand(1, 10),
            'book_id' => rand(1, 20),
            'status' =>  'ACCEPTED',
            'request_processed_at' => Carbon::now(),
            'request_managed_by' => 1,
            'deadline' => Carbon::now()->addDays(rand(7, 30)),
            'created_at' => Carbon::now(),
        ]);
        // LATE
        DB::table('borrows')->insert([
            'reader_id' => rand(1, 10),
            'book_id' => rand(1, 20),
            'status' =>  'ACCEPTED',
            'request_processed_at' => Carbon::now()->subDays(3),
            'request_managed_by' => 1,
            'deadline' => Carbon::now()->subDays(2),
            'created_at' => Carbon::now(),
        ]);
        // REJECTED
        DB::table('borrows')->insert([
            'reader_id' => rand(1, 10),
            'book_id' => rand(1, 20),
            'status' =>  'REJECTED',
            'request_processed_at' => Carbon::now(),
            'request_managed_by' => 1,
            'created_at' => Carbon::now(),
        ]);
        // RETURNED
        DB::table('borrows')->insert([
            'reader_id' => rand(1, 10),
            'book_id' => rand(1, 20),
            'status' =>  'RETURNED',
            'request_processed_at' => Carbon::now()->subDays(10),
            'request_managed_by' => 1,
            'deadline' => Carbon::now()->subDays(2),
            'returned_at' => Carbon::now()->subDays(3),
            'return_managed_by' => 1,
            'created_at' => Carbon::now(),
        ]);
        // PENDING
        Borrow::factory(10)->create();
    }
}
