<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Food;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Payment;
use App\Models\Meal;
use Illuminate\Support\Facades\Schema;
use Yabacon\Paystack;

class PaymentController extends Controller{
    public function redirectToGateway($id){
        $food = Food::findOrFail($id);

        session([
            'meal_id' => $food->id,
            'meal_name' => $food->name,
            'meal_price' => $food->price,
            'meal_quantity' => 1,
        ]);
        session()->save();

        $paystack = new Paystack(env('PAYSTACK_SECRET_KEY'));

        try {
            $response = $paystack->transaction->initialize([
                'amount' => $food->price * 100, 
                'email' => auth()->user()->email,
                'callback_url' => route('payment.callback'),
            ]);

            return redirect($response->data->authorization_url);

        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage() . " (Error paying for food ID: " . $id . ")");
        }
    }

    public function handleCallback(Request $request){
        $reference = $request->query('reference');

        $paystack = new Paystack(env('PAYSTACK_SECRET_KEY'));

        try {
            $tranx = $paystack->transaction->verify([
                'reference' => $reference,
            ]);

            if ($tranx->data->status === 'success') {
                if (!auth()->check() || !session()->has('meal_name') || !session()->has('meal_id')) {
                    return redirect('/meal')->with('error', 'An error occurred, please try again. Your session might have expired.');
                }

                $quantity = (int) session('meal_quantity', 1);
                $price = (float) session('meal_price');
                $user = auth()->user();

                $orderData = [
                    'user_id' => auth()->id(),
                    'total' => $price * $quantity,
                    'total_price' => $price * $quantity,
                    'status' => 'paid',
                    'address' => $user->address ?? 'Not Provided',
                    'phone' => $user->phone ?? 'Not Provided',
                ];

                if (Schema::hasColumn('orders', 'name')) {
                    $orderData['name'] = $user->name;
                }

                $order = Order::create($orderData);

                OrderItem::create([
                    'order_id' => $order->id,
                    'food_id' => (int) session('meal_id'),
                    'quantity' => $quantity,
                    'price' => $price,
                ]);

                $meal = (object) ['name' => session('meal_name'), 'price' => session('meal_price')];
                session()->forget(['meal_id', 'meal_name', 'meal_price', 'meal_quantity']);
                return view('payment', compact('user', 'meal'));
            }
        } catch (\Exception $e) {
            return redirect('/meal')->with('error', 'Payment verification failed: ' . $e->getMessage());
        }

        return redirect('/meal')->with('error', 'Payment failed.');
    }

    public function process(Request $request, $id)
    {
        $user = auth()->user();
        $meal = Meal::findOrFail($id);
    
        $payment = new Payment();
        $payment->user_id = $user->id;
        $payment->meal_id = $meal->id;
        $payment->amount = $meal->price;
        $payment->status = 'pending';
        $payment->save();
    
        return redirect()->back()->with('success', 'Payment initiated.');
    }

    public function success($id){
        $payment = Payment::findOrFail($id);
        return view('payment', [
            'payment' => $payment,
            'meal' => $payment->meal 
        ]);
    }

    public function store($id){
        $user = auth()->user(); 
        $meal = Meal::findOrFail($id);

        $payment = new Payment();
        $payment->user_id = $user->id;
        $payment->meal_id = $meal->id;
        $payment->amount = $meal->price; 
        $payment->status = 'pending';
        $payment->save();

        return redirect()->route('payment.success', ['id' => $payment->id]);
    }
}