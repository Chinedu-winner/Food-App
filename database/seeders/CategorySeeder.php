<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder{
    public function run(): void{
        $categories = [
            ['name' => 'Nigerian',     'slug' => 'nigerian'],
            ['name' => 'Continental',  'slug' => 'continental'],
            ['name' => 'Snacks',       'slug' => 'snacks'],
            ['name' => 'Soups',        'slug' => 'soups'],
        ];

        foreach ($categories as $category) {
            \App\Models\Category::create($category);
        }
    }
}