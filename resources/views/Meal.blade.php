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
    'Smoky Jollof Rice'      => 'https://images.unsplash.com/photo-1567620905732-2d1ec7ab7445?w=600',
    'Pounded Yam & Egusi'    => 'https://images.unsplash.com/photo-1627993427772-27712398516d?w=600',
    'Amala & Ewedu'          => 'https://images.unsplash.com/photo-1629845774847-063851b9e591?w=600',
    'Efo Riro'               => 'https://images.unsplash.com/photo-1543363363-2395a123df65?w=600',
    'Beef Suya'              => 'https://images.unsplash.com/photo-1574484284002-952d92456975?w=600',
    'Goat Meat Pepper Soup'  => 'https://images.unsplash.com/photo-1604152135912-04a022e23696?w=600',
    'Moi Moi'                => 'https://images.unsplash.com/photo-1579546929518-9e396f3cc809?w=600',
    'Akara'                  => 'https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?w=600',
    'Banga Soup & Starch'    => 'https://images.unsplash.com/photo-1512621776951-a57141f2eefd?w=600',
    'Ofada Rice & Sauce'     => 'https://images.unsplash.com/photo-1596236906666-b3281c85304b?w=600',
    'Afang Soup'             => 'https://images.unsplash.com/photo-1547592180-85f173990554?w=600',
    'Edikang Ikong'          => 'https://images.unsplash.com/photo-1512058564366-18510be2db19?w=600',
    'Tuwo Shinkafa'          => 'https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?w=600',
    'Kilishi'                => 'https://images.unsplash.com/photo-1613476435017-9159518d8442?w=600',
    'Nkwobi'                 => 'https://images.unsplash.com/photo-1606787366850-de6330128bfc?w=600',
    'Oha Soup'               => 'https://images.unsplash.com/photo-1543362906-ac1b481287f1?w=600',
    'Bitterleaf Soup'        => 'https://images.unsplash.com/photo-1627993427772-27712398516d?w=600',
    'Abacha (African Salad)' => 'https://images.unsplash.com/photo-1626132647523-66f5bf380027?w=600',
    'Ukwa'                   => 'https://images.unsplash.com/photo-1604329760661-e71dc70844f3?w=600',
    'Creamy Mushroom Pasta'  => 'https://images.unsplash.com/photo-1621996346565-e3dbc646d9a9?w=600',
    'Grilled Fish Tacos'     => 'https://images.unsplash.com/photo-1565299585323-38d6b0865b47?w=600',
    'Beef Steak Frites'      => 'https://images.unsplash.com/photo-1558030006-450675393462?w=600',
    'Thai Green Curry'       => 'https://images.unsplash.com/photo-1455619452474-d2be8b1e70cd?w=600',
    'Shanghai Fried Rice'    => 'https://images.unsplash.com/photo-1603133872878-684f208fb84b?w=600',
    'Margherita Pizza'       => 'https://images.unsplash.com/photo-1574071318508-1cdbab80d002?w=600',
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
            <h1 class="text-4xl font-extrabold tracking-tight text-red-900 sm:text-5xl">FoodWin Menu</h1>
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

                        <a href="{{ route('pay', $food->id) }}" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-orange-500 transition-colors shadow-lg shadow-orange-200">Order Now</a>
                    </div>
                </div>
            @empty
          @endforelse
        </div>
    
        <!-- 2. Pounded Yam & Egusi -->
        <div class="menu-card-grid grid grid-cols-1 gap-y-10 gap-x-6 sm:grid-cols-2 lg:grid-cols-3 xl:gap-x-8 pb-12">
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1627993427772-27712398516d?q=80&w=600&auto=format&fit=crop" alt="Pounded Yam and Egusi" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Pounded Yam & Egusi</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Soft pounded yam paired with rich Egusi soup and assorted meat.</p>
            <span class="text-2xl font-bold text-bistro-price">$15.50</span>
            <div class="flex items-center justify-between">
              <div class="text-xl text-bistro-star flex items-center">
                <span class="text-gray-400 text-lg ml-2">4.9</span>
                  <a href="{{ route('pay', 1) }}" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</a>
              </div>
            </div>
          </div>
        </div>

        <!-- 3. Amala & Ewedu -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1629845774847-063851b9e591?q=80&w=600&auto=format&fit=crop" alt="Amala and Ewedu" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Amala & Ewedu</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Fluffy yam flour dough served with Ewedu leaf soup and Gbegiri.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$14.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.7</span>              
                <form action="{{route ('pay', ['id' => 2])}}" method="GET" class="ml-4">
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 4. Efo Riro -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1543363363-2395a123df65?q=80&w=600&auto=format&fit=crop" alt="Efo Riro" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Efo Riro</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Rich spinach stew cooked with locust beans, fish, and meats.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$13.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>             
                <form action="{{route ('pay', ['id' => 3])}}" method="GET" class="ml-4">
                  @csrf
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>


        <!-- 5. Suya -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1574484284002-952d92456975?q=80&w=600&auto=format&fit=crop" alt="Suya" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Beef Suya</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Spicy grilled beef skewers seasoned with traditional Yaji spice.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$10.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.9</span>             
                <form action="{{route ('pay', ['id' => 4])}}" method="GET" class="ml-4">
                  @csrf
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
  
        <!-- 6. Pepper Soup -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1604152135912-04a022e23696?q=80&w=600&auto=format&fit=crop" alt="Pepper Soup" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Goat Meat Pepper Soup</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Hot and spicy broth made with tender goat meat and herbs.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$11.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.6</span>
                <form action="{{route ('pay', ['id' => 5])}}" method="GET" class="ml-4">
                  @csrf 
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 7. Moi Moi -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1579546929518-9e396f3cc809?q=80&w=600&auto=format&fit=crop" alt="Moi Moi" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Moi Moi</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Steamed bean pudding made with peppers, onions, and egg.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$5.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>              
                <form action="{{route ('pay', ['id' => 6])}}" method="GET" class="ml-4">
                  @csrf
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 8. Akara -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1601004890684-d8cbf643f5f2?q=80&w=600&auto=format&fit=crop" alt="Akara" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Akara</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Crispy fried bean cakes, perfect for breakfast or a snack.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$4.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.5</span>             
                <form action="{{route ('pay', ['id' => 7])}}" method="GET" class="ml-4">
                  @csrf
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 9. Banga Soup -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1512621776951-a57141f2eefd?q=80&w=600&auto=format&fit=crop" alt="Banga Soup" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Banga Soup & Starch</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Palm nut soup served with traditional starch or pounded yam.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$16.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.9</span>              
                <form action="{{route ('pay', ['id' => 8])}}" method="GET" class="ml-4">
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 10. Ofada Rice -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1596236906666-b3281c85304b?q=80&w=600&auto=format&fit=crop" alt="Ofada Rice" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Ofada Rice & Sauce</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Local rice variety served with spicy Ayamase pepper sauce.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$13.99</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.7</span>           
                <form action="{{route ('pay', ['id' => 9])}}" method="GET" class="ml-4">
                  @csrf
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 11. Afang Soup -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1547592180-85f173990554?q=80&w=600&auto=format&fit=crop" alt="Afang Soup" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Afang Soup</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Nutritious vegetable soup native to the Efik people, served with fufu.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$15.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>             
                <form action="{{route ('pay', ['id' => 10])}}" method="GET" class="ml-4">
                  @csrf
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1512058564366-18510be2db19?q=80&w=600&auto=format&fit=crop" alt="Edikang Ikong" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Edikang Ikong</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Vegetable soup made with pumpkin leaves and waterleaf, rich in meat.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$15.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.9</span>            
                <form action="{{route ('pay', ['id' => 11])}}" method="GET" class="ml-4">
                  @csrf
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 13. Tuwo Shinkafa -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1586528116311-ad8dd3c8310d?q=80&w=600&auto=format&fit=crop" alt="Tuwo Shinkafa" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Tuwo Shinkafa</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Northern Nigerian rice pudding served with Miyan Kuka or Taushe.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$12.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.6</span>           
                <form action="{{route ('pay', ['id' => 12])}}" method="GET" class="ml-4">
                  @csrf
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 14. Kilishi -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1613476435017-9159518d8442?q=80&w=600&auto=format&fit=crop" alt="Kilishi" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Kilishi</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Dried, spicy beef jerky, a savory and fiery snack.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$12.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>              
                <form action="{{route ('pay', ['id' => 13])}}" method="GET" class="ml-4">
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 15. Nkwobi -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1606787366850-de6330128bfc?q=80&w=600&auto=format&fit=crop" alt="Nkwobi" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Nkwobi</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Spicy cow foot delicacy cooked in rich palm oil sauce.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$18.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.9</span>             
                <form action="{{route ('pay', ['id' => 14])}}" method="GET" class="ml-4">
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 16. Isi Ewu -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1574484284002-952d92456975?q=80&w=600&auto=format&fit=crop" alt="Isi Ewu" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Isi Ewu</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Traditional spiced goat head dish, a delicacy for special occasions.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$20.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>             
                <form action="{{route ('pay', ['id' => 15])}}" method="GET" class="ml-4">
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 17. Oha Soup -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1543362906-ac1b481287f1?q=80&w=600&auto=format&fit=crop" alt="Oha Soup" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Oha Soup</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Delicious soup made with tender Oha leaves and cocoa yam thickener.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$14.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.7</span>               
                <form action="{{route ('pay', ['id' => 16])}}" method="GET" class="ml-4">
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 18. Bitterleaf Soup -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1627993427772-27712398516d?q=80&w=600&auto=format&fit=crop" alt="Bitterleaf Soup" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Bitterleaf Soup</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Traditional soup made with bitter leaves, cocoyam, and assorted meats.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$14.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.6</span>          
                <form action="{{route ('pay', ['id' => 17])}}" method="GET" class="ml-4">
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <!-- 19. Abacha -->
        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1626132647523-66f5bf380027?q=80&w=600&auto=format&fit=crop" alt="Abacha" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Abacha (African Salad)</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">Cassava flakes tossed in palm oil sauce with garden egg and fish.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$9.00</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★★ <span class="text-gray-400 text-lg ml-2">4.8</span>           
                <form action="{{route ('pay', ['id' => 18])}}" method="GET" class="ml-4">
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>

        <div class="bg-white rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl hover:-translate-y-2 transition-all duration-300 flex flex-col h-full">
          <img src="https://images.unsplash.com/photo-1604329760661-e71dc70844f3?q=80&w=600&auto=format&fit=crop" alt="Ukwa" class="w-full h-56 md:h-64 min-h-[14rem] object-cover">
          <div class="p-6 flex flex-col justify-between flex-1">\n
            <h3 class="text-2xl font-semibold text-gray-800 mb-2">Ukwa</h3>
            <p class="text-gray-600 mb-6 min-h-[3rem]">African breadfruit porridge cooked with dried fish and spices.</p>
            <div class="flex items-center justify-between">
              <span class="text-2xl font-bold text-bistro-price">$16.50</span>
              <div class="text-xl text-bistro-star flex items-center">
                ★★★★☆ <span class="text-gray-400 text-lg ml-2">4.7</span>               
                <form action="{{route ('pay', ['id' => 19])}}" method="GET" class="ml-4">
                  <button type="submit" class="w-full inline-flex justify-center items-center px-6 py-3 border border-transparent text-base font-medium rounded-xl text-white bg-orange-600 hover:bg-orange-700 transition-colors shadow-lg shadow-orange-200">Order Now</button>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <footer class="mt-24 pt-10 border-t border-gray-300 text-center text-gray-600 text-sm">Prices are in USD • All ratings based on customer reviews • Menu updated February 2026</footer>
  </div>
</body>
</html>