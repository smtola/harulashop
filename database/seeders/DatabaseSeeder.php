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

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
        Category::create(['name' => 'Electronics']);
        Category::create(['name' => 'Clothing']);

        Product::create([
            'name' => 'Laptop',
            'description' => 'A powerful laptop.',
            'price' => 999.99,
            'stock' => 10,
            'category_id' => 1,
            'image' => 'products/laptop.jpg', // Placeholder path
        ]);
        Product::create([
            'name' => 'T-Shirt',
            'description' => 'A comfy t-shirt.',
            'price' => 19.99,
            'stock' => 50,
            'category_id' => 2,
            'image' => 'products/tshirt.jpg', // Placeholder path
        ]);
    }
}
