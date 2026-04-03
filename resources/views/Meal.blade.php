<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nigerian Meals - FoodWin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-50 font-sans antialiased">
@php
$foodImageMap = [
    'Smoky Jollof Rice' => 'https://images.unsplash.com/photo-1593629238745-de3d90f491a5?q=80&w=600&auto=format&fit=crop',
    'Pounded Yam & Egusi' => 'https://images.unsplash.com/photo-1627993427772-27712398516d?q=80&w=600&auto=format&fit=crop',
    'Amala & Ewedu' => 'https://images.unsplash.com/photo-1629845774847-063851b9e591?q=80&w=600&auto=format&fit=crop',
    'Efo Riro' => 'https://images.unsplash.com/photo-1543363363-2395a123df65?q=80&w=600&auto=format&fit=crop',
    'Suya' => 'https://images.unsplash.com/photo-1574484284002-952d92456975?q=80&w=600&auto=format&fit=crop',
    'Pepper Soup' => 'https://images.unsplash.com/photo-1604152135912-04a022e23696?q=80&w=600&auto=format&fit=crop',
    'Moi Moi' => 'https://images.unsplash.com/photo-1579546929518-9e396f3cc809?q=80&w=600&auto=format&fit=crop',
    'Akara' => 'https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?q=80&w=600&auto=format&fit=crop',
    'Banga Soup' => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=600&auto=format&fit=crop',
    'Ofada Rice' => 'https://images.unsplash.com/photo-1596236906666-b3281c85304b?q=80&w=600&auto=format&fit=crop',
    'Afang Soup' => 'https://images.unsplash.com/photo-1547592180-85f173990554?q=80&w=600&auto=format&fit=crop',
    'Edikang Ikong' => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?q=80&w=600&auto=format&fit=crop',
    'Tuwo Shinkafa' => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=600&auto=format&fit=crop',
    'Kilishi' => 'https://images.unsplash.com/photo-1613476435017-9159518d8442?q=80&w=600&auto=format&fit=crop',
    'Nkwobi' => 'https://images.unsplash.com/photo-1606787366850-de6330128bfbc?q=80&w=600&auto=format&fit=crop',
    'Isi Ewu' => 'https://images.unsplash.com/photo-1574484284002-952d92456975?q=80&w=600&auto=format&fit=crop',
    'Oha Soup' => 'https://images.unsplash.com/photo-1543362906-ac1b481287f1?q=80&w=600&auto=format&fit=crop',
    'Bitterleaf Soup' => 'https://images.unsplash.com/photo-1627993427772-27712398516d?q=80&w=600&auto=format&fit=crop',
    'Abacha' => 'https://images.unsplash.com/photo-1626132647523-66f5bf380027?q=80&w=600&auto=format&fit=crop',
    'Ukwa' => 'https://images.unsplash.com/photo-1604329760661-e71dc70844f3?q=80&w=600&auto=format&fit=crop',
    'Creamy Mushroom Pasta' => 'https://images.unsplash.com/photo-1621996346565-e3dbc353d2e5?q=80&w=600&auto=format&fit=crop',
    'Grilled Fish Tacos' => 'https://images.unsplash.com/photo-1551504734-5ee1c4a1479b?q=80&w=600&auto=format&fit=crop',
    'Beef Steak Frites' => 'https://images.unsplash.com/photo-1546833999-b9f581a1996d?q=80&w=600&auto=format&fit=crop',
    'Thai Green Curry' => 'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?q=80&w=600&auto=format&fit=crop',
    'Shanghai Fried Rice' => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?q=80&w=600&auto=format&fit=crop',
    'Margherita Pizza' => 'https://images.unsplash.com/photo-1513104890138-7c749659a591?q=80&w=600&auto=format&fit=crop',
];

$defaultImages = [
    'Jollof Rice' => 'https://via.placeholder.com/400x300?text=Jollof+Rice',
    'Fried Rice' => 'https://via.placeholder.com/400x300?text=Fried+Rice',
    'Egusi Soup' => 'https://via.placeholder.com/400x300?text=Egusi+Soup',
    'Efo Riro' => 'https://via.placeholder.com/400x300?text=Efo+Riro',
    'Pounded Yam' => 'https://via.placeholder.com/400x300?text=Pounded+Yam',
    'Suya' => 'https://via.placeholder.com/400x300?text=Suya',
    'Moi Moi' => 'https://via.placeholder.com/400x300?text=Moi+Moi',
    'Akara' => 'https://via.placeholder.com/400x300?text=Akara',
    'Banga Soup' => 'https://via.placeholder.com/400x300?text=Banga+Soup',
    'Ofe Nsala' => 'https://via.placeholder.com/400x300?text=Ofe+Nsala',
];
@endphp
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
        <header class="text-center mb-16">
            <h1 class="text-4xl font-extrabold tracking-tight text-gray-900 sm:text-5xl">Nigerian Meals Menu</h1>
            <p class="mt-4 text-xl text-gray-500 max-w-2xl mx-auto">Explore our authentic Nigerian meals, freshly prepared and ready for delivery.</p>
        </header>

        @if(session('success'))
            <div class="mb-8 p-4 bg-green-50 border-l-4 border-green-400 text-green-700">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="mb-8 p-4 bg-red-50 border-l-4 border-red-400 text-red-700">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8">
            @forelse($foods as $food)
                <div class="group relative bg-gray-50 rounded-2xl shadow-sm border border-gray-100 overflow-hidden flex flex-col h-full hover:shadow-xl transition-all duration-300">
                    <div class="aspect-w-16 aspect-h-9 w-full overflow-hidden bg-gray-200 group-hover:opacity-75 h-56 relative">
                        @php
                            $foodImage = $food->image
                                ? asset('storage/' . $food->image)
                                : ($foodImageMap[$food->name] ?? $defaultImages[$food->name] ?? 'https://via.placeholder.com/400x300?text=' . urlencode($food->name));
                        @endphp
                        <img src="{{ $foodImage }}" alt="{{ $food->name }}" class="h-full w-full object-cover object-center">
                        <div class="absolute top-4 left-4">
                            <span class="inline-flex items-center px-3 py-0.5 rounded-full text-sm font-medium bg-orange-100 text-orange-800 shadow-sm">
                                {{ $food->category->name ?? 'Meal' }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="p-6 flex flex-col flex-grow">
                        <div class="flex justify-between items-center mb-2">
                            <h3 class="text-xl font-bold text-gray-900">{{ $food->name }}</h3>
                            <p class="text-xl font-black text-orange-600">${{ number_format($food->price, 2) }}</p>
                        </div>
                        
                        <p class="text-gray-500 text-sm mb-6 flex-grow">
                            {{ \Illuminate\Support\Str::limit($food->description ?? 'No description provided.', 100) }}
                        </p>

                        <a href="{{ route('pay', $food->id) }}" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors shadow-lg shadow-orange-200">Buy Now</a>
                    </div>
                </div>
            @empty
                <div class="col-span-full text-center py-12">
                    <p class="text-gray-500 text-lg">No meals available at the moment. Please check back later!</p>
                </div>
            @endforelse
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
</body>
</html>
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?q=80&w=600&auto=format&fit=crop" alt="Edikang Ikong" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Edikang Ikong</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Vegetable soup made with pumpkin leaves and waterleaf, rich in meat.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$15.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.9</span>
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
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
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300">
          <img src="https://images.unsplash.com/photo-1604329760661-e71dc70844f3?q=80&w=600&auto=format&fit=crop" alt="Ukwa" class="w-full h-56 md:h-64 object-cover">
          <div class="p-6">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Ukwa</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">African breadfruit porridge cooked with dried fish and spices.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$16.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.7</span>
                @if($food)
                <form action="{{route ('pay', ['id' => $food->id])}}" method="GET" class="ml-4">
                  <button type="submit" class="px-3 py-1 bg-green-500 text-white rounded-lg hover:bg-green-600 transition-colors">Order Now</button>
                </form>
                @else
                <span class="ml-4 text-red-500">No meals available</span>
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>

    <footer class="mt-24 pt-10 border-t border-gray-300 text-center text-gray-600 text-sm">Prices are in USD • All ratings based on customer reviews • Menu updated February 2026</footer>
  </div>

</body>
</html>
<script>
  const colors = ['bg-red-500',
    'bg-blue-500', 'bg-green-500',
    'bg-yellow-500',];
  function randomBg(){
    const box = document.getElementById('box'); 
    const random = colors[Math.floor(Math.random() * colors.length)];
    box.className = "w-full h-40 " + random;
  }
  setInterval(randomBg, 4000); 
</script>