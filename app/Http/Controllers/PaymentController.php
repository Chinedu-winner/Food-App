<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Order;
use Yabacon\Paystack;

class PaymentController extends Controller{
    public function redirectToGateway($id){
        $food = Food::findOrFail($id);

        session([
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
            return back()->with('error', $e->getMessage(),"Paying for food ID: " . $id);
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
                if (!auth()->check() || !session()->has('meal_name')) {
                    return redirect('/meal')->with('error', 'An error occurred, please try again. Your session might have expired.');
                }

                Order::create([
                    'user_id' => auth()->id(),
                    'name'    => auth()->user()->name,
                    'food_name' => session('meal_name'),
                    'quantity' => session('meal_quantity'),
                    'price' => session('meal_price'),
                    'total' => session('meal_price') * session('meal_quantity', 1),
                    'status' => 'paid',
                    'address' => auth()->user()->address ?? 'Not Provided',
                    'phone' => auth()->user()->phone ?? 'Not Provided',
                ]);

                $user = auth()->user();
                $meal = (object) ['name' => session('meal_name'), 'price' => session('meal_price')];
                session()->forget(['meal_name', 'meal_price', 'meal_quantity']);
                return view('payment', compact('user', 'meal'));
            }
        } catch (\Exception $e) {
            return redirect('/meal')->with('error', 'Payment verification failed: ' . $e->getMessage());
        }

        return redirect('/meal')->with('error', 'Payment failed.');
    }
}