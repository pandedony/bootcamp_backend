<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if (!User::exists()) {
            $this->call([
                UserSeeder::class,
            ]);
        }
        if (!Category::exists()) {
            $this->call([
                CategorySeeder::class,
            ]);
        }
    }
}
