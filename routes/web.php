<?php
use App\Http\Controllers\Admin\AdminAccessLogController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Food;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MealController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\AdminAuthController;
use App\Models\Order;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\OrderController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/food', function () {
    return view('food');
})->name('food');

Route::get('/order', function () {
    return view('order'); 
})->name('order');

Route::post('/order', function (Request $request) {
    $data = $request->validate([
        'name' => 'required|string',
        'food_name' => 'required|string',
        'quantity' => 'required|integer|min:1',
        'price' => 'required|numeric|min:0',
    ]); 

    $order = new Order();
    $order->user_id = Auth::id();
    $order->total_price = $data['price'] * $data['quantity'];
    $order->total = $data['price'] * $data['quantity'];
    $order->address = Auth::user()->address ?? 'No address provided';
    $order->status = 'pending';
    $order->save();

    return redirect()->route('track', ['order' => $order->id])->with('success', 'Order placed successfully!');
})->middleware('auth');

Route::get('/track', function () {
    return view('track'); 
})->middleware('auth')->name('track');

Route::post('/track', function (Request $request) {
    $request->validate(['order_id' => 'required|integer']);
    
    $order = Order::where('id', $request->order_id)
        ->where('user_id', Auth::id())
        ->first();

    if (!$order) {
        return back()->withErrors(['order_id' => 'Order not found or does not belong to you.']);
    }
    return redirect()->route('admin.orders.track', ['order' => $order->id]);
})->middleware('auth');

Route::get('/analytics/data', [AnalyticsController::class, 'data']);

Route::get('orders/{order}/status', function($order) { 
    return "Status of order:" . $order;
})->name('orders.status');

Route::get('/dashboard/analytics', 
    [App\Http\Controllers\AnalyticsController::class, 'index'
])->name('analytics');

Route::get('/login', function () {
    return view('login'); 
})->name('login');

Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email'    => ['required','email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return redirect()->intended('/dashboard');
    }

    return back()->withErrors(['email' => 'The provided credentials do not match our records.'])
        ->onlyInput('email');
})->name('login.submit');

Route::get('/register', function () {
    return view('register'); 
})->name('register');

Route::get('/dashboard/orders/create', [OrderController::class, 'create'])->name('orders.create');
Route::get('/dashboard/orders/search-food', [OrderController::class, 'searchFood'])->name('orders.searchFood');
Route::post('/dashboard/orders/add-item/{food}', [OrderController::class, 'addItem'])->name('orders.addItem');

Route::post('/register', function(Request $request) {
    $data = $request->validate([
        'name'     => ['required','string','max:255'],
        'email'    => ['required','email','max:255','unique:users'],
        'password' => ['required','confirmed','min:8'],
    ]);

    $user = User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password']),
    ]);

    Auth::login($user);

    return redirect('/dashboard');
})->name('register.submit');

Route::get('/meal', function () {
    $foods = Food::all(); 
    return view('Meal',  ['foods' => $foods]);
})->name('meal');

Route::get('/meal', 
    [MealController::class, 'index'
])->name('meal.index');

Route::post('/meal', 
    [MealController::class, 'store'
])->name('meal.store');

Route::get('/pay/{id}', [PaymentController::class,
    'redirectToGateway'
])->name('payment.pay'); 

Route::get('/payment/callback', [PaymentController::class, 
    'handleCallback'
])->name('payment.callback');

Route::get('/pay/{id}', [PaymentController::class, 'pay'])->name('pay');

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->middleware('auth')->name('dashboard');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
    Route::get('/admin/users', [AdminDashboardController::class, 'users'])->name('admin.users');
});

Route::get('login/google', [SocialController::class, 'redirectToGoogle'])->name('login.google'); 
Route::get('login/google/callback', [SocialController::class, 'handleGoogleCallback'])->name('login.google.callback');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');

    Route::get('/access-logs', [AdminAccessLogController::class, 'index'])->name('access.logs');

    Route::resource('food', FoodController::class);

    Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders');
    Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
    Route::get('/orders/{order}/track', [App\Http\Controllers\Admin\OrderController::class, 'track'])->name('orders.track');
    Route::delete('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');

    Route::get('/foods', fn() => "Foods page")->name('foods');
    Route::get('/categories', fn() => "Categories page")->name('categories');
    Route::get('/users', fn() => "Users page")->name('users');
});

Route::get('/create-admin-user', function () {
    $admin = User::create([
        'name' => 'Admin User',
        'email' => 'admin@foodwin.com',
        'password' => Hash::make('password123'),
        'admin_id' => '12345',
        'is_admin' => true,
    ]);
    return "Admin user created! Email: admin@foodwin.com, Password: password123, Admin ID: 12345";
});  

Route::prefix('foods')->name('foods.')->group(function () {
        Route::get('/', [FoodController::class, 'index'])->name('index');
        Route::get('/create', [FoodController::class, 'create'])->name('create');
        Route::post('/', [FoodController::class, 'store'])->name('store');
        Route::get('/{food}/edit', [FoodController::class, 'edit'])->name('edit');
        Route::put('/{food}', [FoodController::class, 'update'])->name('update');
        Route::delete('/{food}', [FoodController::class, 'destroy'])->name('destroy');
    });

Route::delete('/admin/food/{food}', [App\Http\Controllers\Admin\FoodController::class, 'destroy'])
    ->name('admin.food.destroy')
->middleware(['auth', 'admin']);

Route::get('/foods', [FoodController::class, 'index'])->name('food.index');

Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');

Route::prefix('admin')->name('admin.')->middleware(['auth'])->group(function () {
    Route::resource('categories', App\Http\Controllers\Admin\CategoryController::class);
});

Route::prefix('admin')->name('admin.')->middleware(['auth','admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
}); 