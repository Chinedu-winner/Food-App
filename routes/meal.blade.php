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
