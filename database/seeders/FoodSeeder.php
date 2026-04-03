<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;
use App\Models\Category;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Get or create categories
        $nigerianCategory = Category::firstOrCreate(
            ['name' => 'Nigerian'],
            ['slug' => 'nigerian', 'description' => 'Traditional Nigerian cuisine']
        );
        $internationalCategory = Category::firstOrCreate(
            ['name' => 'International'],
            ['slug' => 'international', 'description' => 'International cuisine from around the world']
        );

        $foods = [
            // Nigerian Foods
            ['name' => 'Smoky Jollof Rice', 'category_id' => $nigerianCategory->id, 'price' => 12.99, 'description' => 'Classic party Jollof rice served with fried plantain and grilled chicken.'],
            ['name' => 'Pounded Yam & Egusi', 'category_id' => $nigerianCategory->id, 'price' => 15.50, 'description' => 'Soft pounded yam paired with rich Egusi soup and assorted meat.'],
            ['name' => 'Amala & Ewedu', 'category_id' => $nigerianCategory->id, 'price' => 14.00, 'description' => 'Fluffy yam flour dough served with Ewedu leaf soup and Gbegiri.'],
            ['name' => 'Efo Riro', 'category_id' => $nigerianCategory->id, 'price' => 13.50, 'description' => 'Rich spinach stew cooked with locust beans, fish, and meats.'],
            ['name' => 'Beef Suya', 'category_id' => $nigerianCategory->id, 'price' => 10.00, 'description' => 'Spicy grilled beef skewers seasoned with traditional Yaji spice.'],
            ['name' => 'Goat Meat Pepper Soup', 'category_id' => $nigerianCategory->id, 'price' => 11.00, 'description' => 'Hot and spicy broth made with tender goat meat and herbs.'],
            ['name' => 'Moi Moi', 'category_id' => $nigerianCategory->id, 'price' => 5.00, 'description' => 'Steamed bean pudding made with peppers, onions, and egg.'],
            ['name' => 'Akara', 'category_id' => $nigerianCategory->id, 'price' => 4.50, 'description' => 'Crispy fried bean cakes, perfect for breakfast or a snack.'],
            ['name' => 'Banga Soup & Starch', 'category_id' => $nigerianCategory->id, 'price' => 16.00, 'description' => 'Palm nut soup served with traditional starch or pounded yam.'],
            ['name' => 'Ofada Rice & Sauce', 'category_id' => $nigerianCategory->id, 'price' => 13.99, 'description' => 'Local rice variety served with spicy Ayamase pepper sauce.'],
            ['name' => 'Afang Soup', 'category_id' => $nigerianCategory->id, 'price' => 15.00, 'description' => 'Nutritious vegetable soup native to the Efik people, served with fufu.'],
            ['name' => 'Edikang Ikong', 'category_id' => $nigerianCategory->id, 'price' => 15.50, 'description' => 'Vegetable soup made with pumpkin leaves and waterleaf, rich in meat.'],
            ['name' => 'Tuwo Shinkafa', 'category_id' => $nigerianCategory->id, 'price' => 12.50, 'description' => 'Northern Nigerian rice pudding served with Miyan Kuka or Taushe.'],
            ['name' => 'Kilishi', 'category_id' => $nigerianCategory->id, 'price' => 12.00, 'description' => 'Dried, spicy beef jerky, a savory and fiery snack.'],
            ['name' => 'Nkwobi', 'category_id' => $nigerianCategory->id, 'price' => 18.00, 'description' => 'Spicy cow foot delicacy cooked in rich palm oil sauce.'],
            ['name' => 'Isi Ewu', 'category_id' => $nigerianCategory->id, 'price' => 20.00, 'description' => 'Traditional spiced goat head dish, a delicacy for special occasions.'],
            ['name' => 'Oha Soup', 'category_id' => $nigerianCategory->id, 'price' => 14.50, 'description' => 'Delicious soup made with tender Oha leaves and cocoa yam thickener.'],
            ['name' => 'Bitterleaf Soup', 'category_id' => $nigerianCategory->id, 'price' => 14.00, 'description' => 'Traditional soup made with bitter leaves, cocoyam, and assorted meats.'],
            ['name' => 'Abacha (African Salad)', 'category_id' => $nigerianCategory->id, 'price' => 9.00, 'description' => 'Cassava flakes tossed in palm oil sauce with garden egg and fish.'],
            ['name' => 'Ukwa', 'category_id' => $nigerianCategory->id, 'price' => 16.50, 'description' => 'African breadfruit porridge cooked with dried fish and spices.'],
            
            // International Foods
            ['name' => 'Creamy Mushroom Pasta', 'category_id' => $internationalCategory->id, 'price' => 17.50, 'description' => 'Fettuccine, wild mushrooms, truffle cream sauce, parmesan.'],
            ['name' => 'Grilled Fish Tacos', 'category_id' => $internationalCategory->id, 'price' => 13.00, 'description' => 'Fresh grilled fish with cabbage slaw, lime crema, and cilantro.'],
            ['name' => 'Beef Steak Frites', 'category_id' => $internationalCategory->id, 'price' => 22.00, 'description' => 'Premium beef steak with crispy French fries and garlic butter.'],
            ['name' => 'Thai Green Curry', 'category_id' => $internationalCategory->id, 'price' => 15.00, 'description' => 'Creamy green curry with chicken, basil, and jasmine rice.'],
            ['name' => 'Shanghai Fried Rice', 'category_id' => $internationalCategory->id, 'price' => 12.00, 'description' => 'Wok-fried rice with shrimp, egg, and mixed vegetables.'],
            ['name' => 'Margherita Pizza', 'category_id' => $internationalCategory->id, 'price' => 14.00, 'description' => 'Classic Italian pizza with fresh mozzarella, basil, and San Marzano tomatoes.'],
        ];

        foreach ($foods as $food) {
            Food::firstOrCreate(
                ['name' => $food['name']],
                array_merge($food, ['status' => 'active'])
            );
        }
    }
}
