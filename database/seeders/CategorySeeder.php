<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Check if categories exist
        if (Category::count() > 0) {
            $this->command->info('Categories already exist. Skipping seeding.');
            return;
        }

        // Categories do not exist, proceed with seeding
        $categories = [
            ['name' => 'Kaos'],
            ['name' => 'Celana'],
            ['name' => 'Sepatu'],
            ['name' => 'Jaket'],
        ];

        DB::table('categories')->insert($categories);

        $this->command->info('Categories seeded successfully.');
    }
}
