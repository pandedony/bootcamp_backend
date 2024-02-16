<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Category::factory()->count(10)->create();

        $categories = [
            ['name' => 'Electronics'],
            ['name' => 'Clothing'],
            ['name' => 'Books'],
            ['name' => 'Home and Garden'],
            ['name' => 'Toys and Games'],
            ['name' => 'Sports and Outdoors'],
            ['name' => 'Health and Beauty'],
            ['name' => 'Automotive'],
            ['name' => 'Food and Drink'],
            ['name' => 'Music and Instruments']
            // Add more categories as needed
        ];

        // Insert categories into the database
        Category::insert($categories);
    }
}
