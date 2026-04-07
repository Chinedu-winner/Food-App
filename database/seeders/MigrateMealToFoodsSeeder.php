<?php

namespace Database\Seeders;
use App\Models\Food; 
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MigrateMealToFoodsSeeder extends Seeder{
    use App\Models\Food;

public function run(): void{
    Food::create([
        'name' => 'Smoky Jollof Rice',
        'description' => 'Classic party Jollof rice served with fried plantain and grilled chicken.',
        'price' => 12.99,
        'image' => 'https://images.unsplash.com/photo-1596236906666-b3281c85304b?q=80&w=600&auto=format&fit=crop',
        'category' => 'Nigerian Native Delicacies',
        'rating' => 5.0,
        'payment_id' => 7,
    ]);

    Food::create([
        'name' => 'Pounded Yam & Egusi',
        'description' => 'Soft pounded yam paired with rich Egusi soup and assorted meat.',
        'price' => 15.50,
        'image' => 'https://images.unsplash.com/photo-1627993427772-27712398516d?q=80&w=600&auto=format&fit=crop',
        'category' => 'Nigerian Native Delicacies',
        'rating' => 4.9,
        'payment_id' => 8,
    ]);

    Food::create([
        'name' => 'Amala & Ewedu',
        'description' => 'Fluffy yam flour dough served with Ewedu leaf soup and Gbegiri.',
        'price' => 14.00,
        'image' => 'https://images.unsplash.com/photo-1629845774847-063851b9e591?q=80&w=600&auto=format&fit=crop',
        'category' => 'Nigerian Native Delicacies',
        'rating' => 4.7,
        'payment_id' => 9,
    ]);

        foreach ($meals as $meal) {
            Food::create($meal);
        }
    }
}
