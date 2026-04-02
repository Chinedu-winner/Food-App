<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>FoodWin</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            'bistro-bg': '#f8f1e9',
            'bistro-dark': '#2d1e12',
            'bistro-title': '#6b3e26',
            'bistro-subtitle': '#8b5a2b',
            'bistro-heading': '#8b4513',
            'bistro-border': '#d4a373',
            'bistro-price': '#b22222',
            'bistro-star': '#ffa41c',
          },
          animation: {
            'gradient-x': 'gradient-x 15s ease infinite',
          },
          keyframes: {
            'gradient-x': {
              '0%, 100%': { 'background-position': '0% 50%' },
              '50%': { 'background-position': '100% 50%' },
            }
          }
        }
      }
    }
  </script>
</head>
<body class="text-gray-800">
<div class="fixed inset-0 -z-10 overflow-hidden bg-gray-900 bg-cover bg-center transition-all duration-1000 ease-in-out" id='box'>
  <div class="absolute inset-0 bg-white/30 backdrop-blur-[2px]"></div>
</div>
  
  <div class="container mx-auto max-w-6xl px-5 py-16 md:py-20 relative z-10">

    <h1 class="text-center text-5xl md:text-6xl font-extrabold text-bistro-title mb-3 drop-shadow-lg">FoodWin</h1>
    <p class="text-center text-bistro-subtitle text-lg md:text-xl mb-12">Fresh Ingredients • Bold Flavors • Made with Love</p>

              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>
                <form action="{{route ('pay', ['id' => 5])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://www.veggievibesandvines.com/wp-content/uploads/2024/09/Wild-Mushroom-Truffle-Pasta-scaled.jpg" alt="Creamy mushroom fettuccine with truffle sauce" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Creamy Mushroom Pasta</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Fettuccine, wild mushrooms, truffle cream sauce, parmesan</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$17.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★½ <span class="text-gray-400 text-lg ml-2">4.7</span>
                <form action="{{route ('pay', ['id' => 6])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
        

      
    <section class="mb-20">
      <h2 class="text-4xl md:text-5xl font-semibold text-bistro-heading border-b-4 border-bistro-border pb-4 mb-10 inline-block">Nigerian Native Delicacies</h2>
      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1596236906666-b3281c85304b?q=80&w=600&auto=format&fit=crop" alt="Jollof Rice" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Smoky Jollof Rice</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Classic party Jollof rice served with fried plantain and grilled chicken.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$12.99</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">5.0</span>
                <form action="{{route ('pay', ['id' => 7])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
 <!-- 2. Pounded Yam & Egusi -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1627993427772-27712398516d?q=80&w=600&auto=format&fit=crop" alt="Pounded Yam and Egusi" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Pounded Yam & Egusi</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Soft pounded yam paired with rich Egusi soup and assorted meat.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$15.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.9</span>
                <form action="{{route ('pay', ['id' => 8])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 3. Amala & Ewedu -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1629845774847-063851b9e591?q=80&w=600&auto=format&fit=crop" alt="Amala and Ewedu" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Amala & Ewedu</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Fluffy yam flour dough served with Ewedu leaf soup and Gbegiri.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$14.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.7</span>
                <form action="{{route ('pay', ['id' => 9])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 4. Efo Riro -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1543363363-2395a123df65?q=80&w=600&auto=format&fit=crop" alt="Efo Riro" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Efo Riro</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Rich spinach stew cooked with locust beans, fish, and meats.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$13.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>
                <form action="{{route ('pay', ['id' => 10])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>


        <!-- 5. Suya -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1574484284002-952d92456975?q=80&w=600&auto=format&fit=crop" alt="Suya" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Beef Suya</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Spicy grilled beef skewers seasoned with traditional Yaji spice.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$10.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.9</span>
                <form action="{{route ('pay', ['id' => 11])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
  
        <!-- 6. Pepper Soup -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1604152135912-04a022e23696?q=80&w=600&auto=format&fit=crop" alt="Pepper Soup" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Goat Meat Pepper Soup</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Hot and spicy broth made with tender goat meat and herbs.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$11.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.6</span>
                <form action="{{route ('pay', ['id' => 12])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 7. Moi Moi -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1579546929518-9e396f3cc809?q=80&w=600&auto=format&fit=crop" alt="Moi Moi" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Moi Moi</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Steamed bean pudding made with peppers, onions, and egg.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$5.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>
                <form action="{{route ('pay', ['id' => 13])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 8. Akara -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?q=80&w=600&auto=format&fit=crop" alt="Akara" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Akara</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Crispy fried bean cakes, perfect for breakfast or a snack.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$4.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.5</span>
                <form action="{{route ('pay', ['id' => 14])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 9. Banga Soup -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=600&auto=format&fit=crop" alt="Banga Soup" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Banga Soup & Starch</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Palm nut soup served with traditional starch or pounded yam.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$16.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.9</span>
                <form action="{{route ('pay', ['id' => 15])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 10. Ofada Rice -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1596236906666-b3281c85304b?q=80&w=600&auto=format&fit=crop" alt="Ofada Rice" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Ofada Rice & Sauce</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Local rice variety served with spicy Ayamase pepper sauce.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$13.99</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.7</span>
                <form action="{{route ('pay', ['id' => 16])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 11. Afang Soup -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1547592180-85f173990554?q=80&w=600&auto=format&fit=crop" alt="Afang Soup" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Afang Soup</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Nutritious vegetable soup native to the Efik people, served with fufu.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$15.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>
                <form action="{{route ('pay', ['id' => 17])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 12. Edikang Ikong -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?q=80&w=600&auto=format&fit=crop" alt="Edikang Ikong" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Edikang Ikong</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Vegetable soup made with pumpkin leaves and waterleaf, rich in meat.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$15.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.9</span>
                <form action="{{route ('pay', ['id' => 18])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 13. Tuwo Shinkafa -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=600&auto=format&fit=crop" alt="Tuwo Shinkafa" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Tuwo Shinkafa</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Northern Nigerian rice pudding served with Miyan Kuka or Taushe.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$12.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.6</span>
                <form action="{{route ('pay', ['id' => 19])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 14. Kilishi -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1613476435017-9159518d8442?q=80&w=600&auto=format&fit=crop" alt="Kilishi" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Kilishi</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Dried, spicy beef jerky, a savory and fiery snack.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$12.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>
                <form action="{{route ('pay', ['id' => 20])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 15. Nkwobi -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1606787366850-de6330128bfc?q=80&w=600&auto=format&fit=crop" alt="Nkwobi" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Nkwobi</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Spicy cow foot delicacy cooked in rich palm oil sauce.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$18.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.9</span>
                <form action="{{route ('pay', ['id' => 21])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 16. Isi Ewu -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1574484284002-952d92456975?q=80&w=600&auto=format&fit=crop" alt="Isi Ewu" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Isi Ewu</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Traditional spiced goat head dish, a delicacy for special occasions.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$20.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>
                <form action="{{route ('pay', ['id' => 22])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 17. Oha Soup -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1543362906-ac1b481287f1?q=80&w=600&auto=format&fit=crop" alt="Oha Soup" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Oha Soup</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Delicious soup made with tender Oha leaves and cocoa yam thickener.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$14.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.7</span>
                <form action="{{route ('pay', ['id' => 23])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 18. Bitterleaf Soup -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1627993427772-27712398516d?q=80&w=600&auto=format&fit=crop" alt="Bitterleaf Soup" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Bitterleaf Soup</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Traditional soup made with bitter leaves, cocoyam, and assorted meats.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$14.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.6</span>
                <form action="{{route ('pay', ['id' => 24])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 19. Abacha -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1626132647523-66f5bf380027?q=80&w=600&auto=format&fit=crop" alt="Abacha" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Abacha (African Salad)</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Cassava flakes tossed in palm oil sauce with garden egg and fish.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$9.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>
                <form action="{{route ('pay', ['id' => 25])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
            </form>
            </div>
            </div>
          </div>
        </div>
      </div> 
    </section>
  </div>

        <!-- 20. Ukwa -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1604329760661-e71dc70844f3?q=80&w=600&auto=format&fit=crop" alt="Ukwa" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Ukwa</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">African breadfruit porridge cooked with dried fish and spices.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$16.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.7</span>
                <form action="{{route ('pay', ['id' => 26])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

      </div>
    </section>

    <footer class="mt-24 pt-10 border-t border-gray-300 text-center text-gray-600 text-sm">Prices are in USD • All ratings based on customer reviews • Menu updated February 2026</footer>
  </div>

</body>
</html>
<script>
  const colors = ['bg-red-500',
    'bg-blue-500', 'bg-green-500',
    'bg-yellow-500',]
    function randomBg(){
      const box =
      documenet.getElementBy('box'); 
      const random = 
      colour[Math.floor(Math.random()*
    colors.length)];
    
    box.className = "w-full h-40" + random;
    }
    setInterval(randomBg, 4000); 
</script>