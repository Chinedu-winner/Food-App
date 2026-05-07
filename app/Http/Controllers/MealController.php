<?php

namespace App\Http\Controllers;
use App\Models\Food; 
use Illuminate\Http\Request;
class MealController extends Controller{
    public function index(){
        $foods = Food::with('category')
            ->where('status', 'active')
            ->get();
        $food = $foods->first();

        return view('meal', compact('foods', 'food'));
    }

public function store(Request $request){
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'price' => 'required|numeric',
        'description' => 'nullable|string',
        'image' => 'nullable|image|max:2048',
        'status' => 'required|in:active,inactive',
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('foods', 'public');
    }

    $food = Food::create($validated);

    try {
        Activity::create([
            'action' => 'added',
            'food_name' => $food->name,
        ]);
    } catch (\Exception $e) {
        // Activity log failed but food was still saved
    }

    return redirect()->route('admin.foods.index')
        ->with('success', 'Food created successfully!');
}
}