<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation - FoodWin</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gradient-to-br from-gray-50 to-gray-100 min-h-screen flex items-center justify-center py-12 px-4">
    <div class="max-w-md w-full">
        <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
            <div class="bg-gradient-to-r from-green-500 to-emerald-600 px-8 py-12 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 bg-white rounded-full mb-4">
                    <i class="fas fa-check text-green-600 text-3xl"></i>
                </div>
                <h1 class="text-3xl font-bold text-white mb-2">Payment Successful!</h1>
                <p class="text-green-50">Your order has been confirmed</p>
            </div>

            <div class="px-8 py-8">
                <div class="mb-6 pb-6 border-b border-gray-200">
                    <p class="text-sm text-gray-500 uppercase tracking-wide mb-1">Customer Name</p>
                    <p class="text-lg font-semibold text-gray-900">{{ $user->name }}</p>
                </div>

                <div class="bg-gray-50 rounded-xl p-6 mb-6">
                    <div class="flex items-start gap-4">
                        <div class="flex-shrink-0">
                            <div class="flex items-center justify-center h-12 w-12 rounded-lg bg-orange-100">
                                <i class="fas fa-utensils text-orange-600"></i>
                            </div>
                        </div>
                        <div class="flex-1">
                            <p class="text-sm text-gray-500 uppercase tracking-wide mb-1">Food Ordered</p>
                            <p class="text-xl font-bold text-gray-900 mb-1">{{ $meal->name }}</p>
                            <p class="text-2xl font-bold text-orange-600">${{ number_format($meal->price, 2) }}</p>
                        </div>
                    </div>
                </div>

                <div class="bg-blue-50 border border-blue-200 rounded-lg p-4 mb-6 text-center">
                    <div class="flex items-center justify-center gap-2 mb-2">
                        <i class="fas fa-clock text-blue-600"></i>
                        <span class="font-semibold text-blue-900">Estimated Delivery Time</span>
                    </div>
                    <p class="text-lg font-bold text-blue-600">30 Minutes</p>
                    <p class="text-xs text-blue-700 mt-1">Your order is being prepared</p>
                </div>

                <div class="space-y-3 mb-8">
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center justify-center w-6 h-6 bg-green-500 text-white rounded-full text-sm">
                            <i class="fas fa-check"></i>
                        </span>
                        <span class="text-sm text-gray-700"><strong>Payment Confirmed</strong> - Payment received and verified</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center justify-center w-6 h-6 bg-yellow-500 text-white rounded-full text-sm">
                            <i class="fas fa-fire"></i>
                        </span>
                        <span class="text-sm text-gray-700"><strong>Preparing</strong> - Your food is being prepared</span>
                    </div>
                    <div class="flex items-center gap-3">
                        <span class="inline-flex items-center justify-center w-6 h-6 bg-gray-300 text-gray-600 rounded-full text-sm">
                            <i class="fas fa-motorcycle"></i>
                        </span>
                        <span class="text-sm text-gray-500">On The Way - Coming soon</span>
                    </div>
                </div>

                <div class="space-y-3">
                    <a href="/meal" class="w-full bg-gradient-to-r from-orange-500 to-orange-600 hover:from-orange-600 hover:to-orange-700 text-white font-bold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-shopping-bag"></i>
                        Order Again
                    </a>
                    <a href="/dashboard" class="w-full bg-gray-200 hover:bg-gray-300 text-gray-800 font-semibold py-3 px-4 rounded-lg transition duration-300 flex items-center justify-center gap-2">
                        <i class="fas fa-home"></i>
                        Back to Home
                    </a>
                </div>
            </div>

            <div class="bg-gray-50 px-8 py-4 border-t border-gray-200 text-center">
                <p class="text-sm text-gray-600">
                    <i class="fas fa-phone-alt text-orange-600"></i>
                    Need help? <a href="#" class="text-orange-600 hover:text-orange-700 font-semibold">Contact Support</a>
                </p>
            </div>
        </div>

        <div class="mt-6 text-center">
            <p class="text-sm text-gray-600">
                <i class="fas fa-shield-alt text-green-600 mr-1"></i>Your payment is secure and protected</p>
        </div>
    </div>

</body>
</html