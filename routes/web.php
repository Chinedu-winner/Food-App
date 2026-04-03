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
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/food', function () {
    return view('food');
})->name('food');


Route::get('/pay/{id}', 
    [PaymentController::class, 'redirectToGateway'
])->name('pay');

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

Route::get('orders/{order}/status', function($order) { 
    return "Status of order:" . $order;
    })->name('orders.status');

Route::get('/analytics/data', [AnalyticsController::class, 'data']);

Route::get('/dashboard/analytics', [AnalyticsController::class, 'index'])->name('analytics');

Route::get('/login', function () {
    return view('login'); 
})->name('login');

Route::post('/logout', 
    [AuthenticatedSessionController::class, 'destroy'
])->name('logout');

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

Route::get('/meal', 
    [MealController::class, 'index'
])->name('meal.index');

Route::post('/meal', 
    [MealController::class, 'store'
])->name('meal.store');



Route::get('/payment/callback', [PaymentController::class, 
    'handleCallback'
])->name('payment.callback');

Route::get('/dashboard', function () {
    return view('dashboard'); 
})->middleware('auth')->name('dashboard');

Route::get('login/google', [SocialController::class, 'redirectToGoogle'])->name('login.google'); 
Route::get('login/google/callback', [SocialController::class, 'handleGoogleCallback'])->name('login.google.callback');

// Consolidated Admin Routes
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AdminAuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AdminAuthController::class, 'login'])->name('login.submit');
    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/access-logs', [AdminAccessLogController::class, 'index'])->name('access.logs');
        Route::resource('food', FoodController::class);
        Route::resource('categories', CategoryController::class);
        Route::get('/orders', [App\Http\Controllers\Admin\OrderController::class, 'index'])->name('orders');
        Route::get('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'show'])->name('orders.show');
        Route::get('/orders/{order}/track', [App\Http\Controllers\Admin\OrderController::class, 'track'])->name('orders.track');
        Route::delete('/orders/{order}', [App\Http\Controllers\Admin\OrderController::class, 'destroy'])->name('orders.destroy');
        Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
    });
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

Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');

Route::get('/user/profile', [ProfileController::class, 'edit'])
    ->middleware(['auth', 'role:user']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
});

Route::get('/ssl-test', function () {
    return file_get_contents('https://www.google.com');
}); 

// Admin routes
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function() {
    Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('food', FoodController::class, ['as' => 'admin']);
    Route::resource('category', CategoryController::class, ['as' => 'admin']);
    Route::resource('order', OrderController::class, ['as' => 'admin']);
});

// User routes
Route::middleware('auth')->group(function() {
    Route::get('/dashboard', [UserDashboardController::class, 'dashboard'])->name('user.dashboard');
    Route::resource('order', OrderController::class);
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});