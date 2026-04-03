<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Meal;
use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder{
    use WithoutModelEvents;
    public function run(): void{
        // Create categories first
        Category::firstOrCreate(['name' => 'Nigerian']);
        Category::firstOrCreate(['name' => 'International']);

        // Create test user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        // Seed meals using the FoodSeeder
        $this->call(FoodSeeder::class);
        Meal::create(['name' => 'Grilled Salmon', 'price' => 22.99]);
        Meal::create(['name' => 'Creamy Mushroom Pasta', 'price' => 18.99]);
    }
}
