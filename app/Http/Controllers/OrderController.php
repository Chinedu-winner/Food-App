<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller{
    public function track(Order $order){
        return view('orders.track', ['order' => $order]);
    }

    public function status(Order $order): JsonResponse{
        if (Auth::id() !== $order->user_id) {
            return response()->json(['error' => 'Forbidden'], 403);
        }

        return response()->json([
            'status' => $order->status,
            'latitude' => $order->latitude ?? null,
            'longitude' => $order->longitude ?? null,
            'updated_at' => $order->updated_at,
        ]);
    }
    public function index(){
        $orders = Order::with('items.food')->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }
    public function store(Request $request){
        $request->validate([
            'cart' => 'required|array|min:1',
        ]);

        $cartItems = $request->input('cart'); 

        $totalPrice = collect($cartItems)->sum(function($item){
            return $item['price'] * $item['quantity'];
        });
    
        $order = Order::create([
            'user_id' => Auth::id(),
            'total_price' => $totalPrice,
            'address' => Auth::user()->address,
            'status' => 'pending',
    ]);


        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'food_id'  => $item['food_id'],
                'quantity' => $item['quantity'],
                'price'    => $item['price'],
            ]);
        }

        return redirect()->route('orders.track', $order->id)
            ->with('success', 'Order placed successfully!');
    }

    public function searchFood(Request $request){
        $query = $request->input('query');
            if (!$query) return redirect()->route('orders.create');
    
        $response = OpenAI::embeddings()->create([
            'model' => 'text-embedding-3-small',
            'input' => $query,
        ]);
        $queryVector = $response['data'][0]['embedding'];

        $foods = Food::all()->map(function ($food) use ($queryVector) {
            $foodVector = $food->embedding;
            $food->similarity = $this->cosineSimilarity($queryVector, $foodVector);
            return $food;
        })->sortByDesc('similarity'); // highest match first

    return view('orders.create', compact('foods', 'query'));
    }

    private function cosineSimilarity(array $vecA, array $vecB): float{
        $dot = 0;
        $normA = 0;
        $normB = 0;

        foreach ($vecA as $i => $a) {
            $b = $vecB[$i] ?? 0;
            $dot += $a * $b;
            $normA += $a * $a;
            $normB += $b * $b;
        }

        return $dot / (sqrt($normA) * sqrt($normB) + 1e-8);
    }

    public function addItem(Food $food)
{
    $order = auth()->user()->currentOrder(); // your logic to get current order
    $order->items()->create([
        'food_id' => $food->id,
        'quantity' => 1,
    ]);

    return back()->with('success', 'Food added to order!');
}
    }