<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Call the UsersTableSeeder
        $this->call(UsersTableSeeder::class);

        // Call the PostsTableSeeder
        $this->call(PostsTableSeeder::class);
    }
}
