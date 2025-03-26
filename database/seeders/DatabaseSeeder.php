<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);


        $category = Category::create(['name' => 'Electronics', 'description'=>'hello desc']);

        Product::create([
            'name' => 'Smartphone',
            'description'=>'hello desc',
            'price' => 699.99,
            'category_id' => $category->id,
            'stock'=>10,
        ]);
    }
}
