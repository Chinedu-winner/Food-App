<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\Category;
use App\Models\Activity;

class FoodController extends Controller{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(){
        $foods = Food::with('category')->paginate(10);

        $foodsByCategory = $foods->groupBy(function ($food) {
            return $food->category ? $food->category->name : 'Uncategorized';
        });

        return view('admin.foods.index', compact('foods', 'foodsByCategory'));
    }

    public function create(){
        $categories = Category::all();

        return view('admin.foods.create', compact('categories'));
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

        Activity::create([
            'action' => 'added',
            'food_name' => $food->name,
        ]);

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food created successfully.');
    }

    public function edit($id){
        $food = Food::findOrFail($id);
        $categories = Category::all();

        return view('admin.foods.edit', compact('food', 'categories'));
    }

    public function update(Request $request, $id){
        $food = Food::findOrFail($id);

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

        $food->update($validated);

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food updated successfully.');
    }

    public function destroy(Food $food){
        $foodName = $food->name;
        $food->delete();

        Activity::create([
            'action' => 'deleted',
            'food_name' => $foodName,
        ]);

        return redirect()->route('admin.foods.index')
            ->with('success', 'Food deleted successfully.');
    }

    public function showMeal(){
        $foods = Food::all();
        $categories = Category::all();

        return view('meal', compact('foods', 'categories'));
    }
}