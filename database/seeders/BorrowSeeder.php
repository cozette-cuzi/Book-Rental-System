<?php

namespace Database\Seeders;

use App\Models\Borrow;
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
        Borrow::factory(30)->create();
    }
}
