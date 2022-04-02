<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->truncate();
        DB::table('users')->insert([
            'name' => "Cozette Cuzi",
            'email' => 'cozette@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('password'),
            'is_librarian' => true
        ]);
        User::factory(10)->create();
    }
}
