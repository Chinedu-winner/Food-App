<?php
use App\Http\Controllers\Admin\AdminAccessLogController;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Models\User;
use App\Models\Food;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\MealController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\Auth\SocialController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\LoginController; 
use App\Http\Controllers\Admin\AdminAuthController;
use App\Models\Order;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AnalyticsController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/test123', function () {
    return 'Route is working';
});

Route::get('/food', function () {
    return view('food');
})->middleware('auth')->name('food');

Route::get('/admin/orders/{order}', [OrderController::class, 'show'])
    ->name('admin.orders.show');

Route::get('/login', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::get('/pay/{id}', 
    [PaymentController::class, 'redirectToGateway'
])->middleware('auth')->name('pay');

Route::get('/order', 
    [OrderController::class, 'userOrders'
])->middleware('auth')->name('order');

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

Route::get('/payment-success/{id}', 
    [PaymentController::class, 'success'
])->name('payment.success');

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
    })->middleware('auth')->name('orders.status');

Route::get('/analytics/data', 
    [AnalyticsController::class, 'data'
])->middleware('auth');

Route::get('/dashboard/analytics', [AnalyticsController::class, 'index'])->middleware('auth')->name('analytics');

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
})->middleware('guest')->name('login.submit');

Route::get('/register', function () {
    return view('register');
})->middleware('guest')->name('register');

Route::get('/dashboard/orders/create', [OrderController::class, 'create'])->middleware('auth')->name('orders.create');
Route::get('/dashboard/orders/search-food', [OrderController::class, 'searchFood'])->middleware('auth')->name('orders.searchFood');
Route::post('/dashboard/orders/add-item/{food}', [OrderController::class, 'addItem'])->middleware('auth')->name('orders.addItem');

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
    return redirect()->route('dashboard')
        ->with('success', 'Registration successful!');
})->middleware('guest')->name('register.submit');

Route::get('/meal', 
    [MealController::class, 'index'
])->middleware('auth')->name('meal.index');

Route::post('/meal', 
    [MealController::class, 'store'
])->middleware('auth')->name('meal.store');

Route::get('/pay/{id}', 
    [PaymentController::class, 'redirectToGateway'
])->middleware('auth')->name('pay');

Route::get('/payment/callback', [PaymentController::class, 
    'handleCallback'
])->name('payment.callback');

Route::get('login/google', [SocialController::class, 'redirectToGoogle'])->name('login.google'); 
Route::get('login/google/callback', [SocialController::class, 'handleGoogleCallback'])->name('login.google.callback');

Route::get('/dashboard', [App\Http\Controllers\DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::prefix('admin')->name('admin.')->group(function () {
    Route::middleware(['auth', 'admin'])->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'dashboard'])->name('dashboard');
        Route::get('/access-logs', [AdminAccessLogController::class, 'index'])->name('access.logs');
        Route::get('/users', [AdminDashboardController::class, 'users'])->name('users');
        Route::get('/orders', [OrderController::class, 'index'])->name('orders');
        Route::get('/orders/track/{order?}', [OrderController::class, 'track'])->name('orders.track');

        Route::get('/management', [AdminAuthController::class, 'showManagement'])->name('management');
        Route::post('/management', [AdminAuthController::class, 'store'])->name('store');
        Route::delete('/management/{id}', [AdminAuthController::class, 'destroy'])->name('destroy');

        Route::resource('foods', FoodController::class);
        Route::resource('categories', CategoryController::class);
        Route::resource('orders', OrderController::class);
    });

    Route::post('/logout', [AdminAuthController::class, 'logout'])->name('logout');
});

Route::get('/admin/login', function () {
    return view('admin.login');
})->name('admin.login');

Route::post('/admin/login',
    [AdminAuthController::class, 'login'])
->name('admin.login.submit');

Route::post('/checkout', [OrderController::class, 'placeOrder'])->name('order.place');
Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');

Route::get('/admin/edit-id/{id}', [AdminController::class, 'editId'])
    ->name('admin.edit.id');

Route::middleware('auth')->group(function() {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');


Route::middleware(['auth'])->group(function () {
    Route::put('/user/password', [ProfileController::class, 'updatePassword'])->name('password.update');
});

Route::prefix('admin')->middleware(['auth'])->group(function () {
    Route::resource('orders', OrderController::class);

    Route::get('/orders/track/{order}', [OrderController::class, 'track'])
        ->name('admin.orders.track');
});

Route::get('/admin/orders/track/{order}', [OrderController::class, 'track'])
    ->name('admin.orders.track');

Route::post('/logout', [AuthenticatedSessionController::class, 'destroy'])->name('logout');

Route::middleware('auth')->prefix('settings')->name('settings.')->group(function () {
    Route::get('/', [SettingsController::class, 'index'])->name('index');
    Route::get('/edit', [SettingsController::class, 'edit'])->name('edit');

    Route::post('/app', [SettingsController::class, 'updateAppSettings'])->name('app.update');
    Route::post('/profile', [SettingsController::class, 'updateProfile'])->name('profile.update');
    Route::post('/notifications', [SettingsController::class, 'updateNotifications'])->name('notifications.update');
    Route::post('/password', [SettingsController::class, 'updatePassword'])->name('password.update');

    Route::get('/verify-sms', [SettingsController::class, 'showSmsForm'])->name('sms.verify');
    Route::get('/sms/code', [SettingsController::class, 'showSmsConfirmPage'])->name('sms.code');
    Route::post('/send-sms-code', [SettingsController::class, 'sendSmsCode'])->name('sms.send');
    Route::post('/confirm-sms-code', [SettingsController::class, 'confirmSmsCode'])->name('sms.confirm');

    Route::get('/email/verify', [SettingsController::class, 'verifyEmail'])->name('email.verify');
    Route::get('/email/page', [SettingsController::class, 'showEmailVerifyPage'])->name('email.page');
    Route::post('/email/send', [SettingsController::class, 'sendEmailVerification'])->name('email.send');
});

Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', 
function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('dashboard');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::get('/mail-test', function () {
    Mail::raw('Test email from Laravel', function ($message) {
        $message->to('chibundochinedu@gmail.com')
                ->subject('Test Email');
    });

    return "Mail sent!";
});

Route::get('/mail-form', function () {
    return view('mail-form');
});

Route::post('/send-mail', function (Request $request) {

    Mail::raw('Hello 👋 This is a test message from FoodWin!', function ($message) use ($request) {
        $message->to($request->email)
                ->subject('Welcome Email');
    });
    return "Email sent to " . $request->email;
});

Route::get('/admin/{id}/edit-id',  
    [AdminAuthController::class, 'editAdminId'])
->name('admin.edit.id');

Route::post('/admin/{id}/update-id',
    [AdminAuthController::class, 'updateAdminId'])
->name('admin.update.id');

Route::post('/admin/{id}/generate-id', [AdminController::class, 'generateId'])
    ->name('admin.generate.id');


Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/login');
})->name('logout');